<?php

namespace App\Http\Controllers;

use App\Models\AfterProccessProduct;
use App\Models\Category;
use App\Models\DailyProduction;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Raw;
use App\Models\RawStock;
use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\Sample;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Auth;

class FactoryManagerController extends Controller
{
    public $dhpl;
    public function __construct()
    {
        $this->dhpl = DB::connection('dhpl');
    }
    public function dashboard()
    {
        return view('factoryManager.dashboard');
    }
    public function allSamples()
    {
        menuSubmenu('samples', 'allSamples');
        $samples = Sample::orderBy('id', 'DESC')->paginate(50);
        return view('factoryManager.samples.allSamples', compact('samples'));
    }
    public function viewSample(Request $request)
    {
        $sample = Sample::with('sample_items')->find($request->sample);

        return view('factoryManager.samples.viewSamples', compact('sample'));
    }

    public function materials(Request $request)
    {
        $type = $request->type;
        if ($type == 'raw') {
            menuSubmenu('Materials', 'RowMaterials');
            $rawMaterials = Raw::with('category')->where('type', $type)->orderBy('id', 'DESC')->paginate(50);
            $categories = Category::where('type', 'raw')->where('active', true)->get();
            return view('factoryManager.materials.rawMaterials', compact('rawMaterials', 'categories'));
        }
        if ($type == 'pack') {
            menuSubmenu('Materials', 'PackagingMaterials');
            $packaging = Raw::where('type', $type)->orderBy('id', 'DESC')->paginate(50);
            $categories = Category::where('type', 'pack')->where('active', true)->get();
            $medicine_types = $this->dhpl->table('ecommerce_categories')->get();
            return view('factoryManager.materials.packaging', compact('packaging', 'categories', 'medicine_types'));
        }
        if ($type == 'stationery') {
            menuSubmenu('Materials', 'stationeryMaterials');
            $stationeries = Raw::where('type', $type)->with('category')->orderBy('id', 'DESC')->paginate(50);
            return view('factoryManager.materials.stationeries', compact('stationeries', 'type'));
        }
    }

    function stockedMaterials(Request $request)
    {
        menuSubmenu('stockedMaterials', 'all');
        $type = $request->type;
        if ($request->type == 'raw') {
            menuSubmenu('stockedMaterials', 'rawStockedMaterials');
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->where('type', 'raw')->paginate(30);
        } elseif ($request->type == 'pack') {
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->where('type', 'pack')->paginate(30);
            $type  = 'Package';
        } elseif ($request->type == 'stationery') {
            menuSubmenu('stockedMaterials', 'stationeryStockedMaterials');
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->with('requisition', 'raw')->where('type', 'stationery')->paginate(30);
        } else {
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->paginate(30);
        }
        return view('factoryManager.stockedMaterials', compact('stockedMaterials', 'type'));
    }

    public function readyProducts(Request $request)
    {
        menuSubmenu('readyProducts', 'readyProductsAll');
        $readyProducts = AfterProccessProduct::where('status', 'in_stocked')->groupBy('product_id')->groupBy('unit')->groupBy('unit_value')->latest()->paginate(30);
        return view('factoryManager.readyProducts', compact('readyProducts'));
    }

    public function dailyProduction(Request $request)
    {
        $products = $this->dhpl->table('ecommerce_products')->orderBy('name')->paginate(30);
        $type = $request->type;
        menuSubmenu('dailyProductions', $type . 'Productions');
        if ($type == 'all') {
            $dailyProduction = DailyProduction::latest()->paginate(20);
        } elseif ($type == 'rejected') {
            $dailyProduction = DailyProduction::latest()->where('status', 'rejected')->paginate(20);
        } elseif ($type == 'approved') {
            $dailyProduction = DailyProduction::latest()->where('status', 'approved')->paginate(20);
        } elseif ($type == 'pending') {
            $dailyProduction = DailyProduction::latest()->where('status', 'pending')->paginate(20);
        } else {
            return back();
        }

        return view('factoryManager.dailyProduction.index', compact('products', 'dailyProduction', 'type'));
    }
    public function updateDailyProductionStatus(Request $request)
    {
        $production = DailyProduction::find($request->production);
        $production->status = $request->status;
        $production->save();
        return redirect()->back()->with('success', 'Daily Production status Updated Successfully Successfully');
    }

    //Requisition

    public function requisitions(Request $request)
    {
        $type = $request->type;
        menuSubmenu('requisition', $type);
        if ($type == 'all') {
            $requisitions = Requisition::orderByRaw("FIELD(status,'pending','collected','approved','stocked')")->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
        } elseif ($type == 'pending') {
            $requisitions = Requisition::where('status', 'pending')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'approved') {
            $requisitions = Requisition::where('status', 'approved')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'pending_purchase') {
            $requisitions = Requisition::where('status', 'pending_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'approved_purchase') {
            $requisitions = Requisition::where('status', 'approved_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'purchase') {
            $requisitions = Requisition::where('status', 'purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'collected') {
            $requisitions = Requisition::where('status', 'collected')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'stocked') {
            $requisitions = Requisition::where('status', 'stocked')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } else {
            return back();
        }

        return view('factoryManager.requisition.requisitionAll', compact('requisitions', 'type'));
    }

    public function requisitionProcess(Request $request)
    {

        $requisition = Requisition::find($request->requisition);
        $suppliers = Supplier::where('active', true)->orderBy('name')->get();
        return view('factoryManager.requisition.requisition', compact('requisition', 'suppliers'));
    }

    public function requisitionProcessUpdate(Request $request)
    {
        $request->validate([
            'quantity.*' => 'required',
        ]);
        $requisition = Requisition::find($request->requisition);
        if ($requisition->status == $request->type) {
            return redirect()->back()->with('warning', "You have Already $request->type");
        }
        if ($request->type == 'approved') {
            $requisition->approved_at = Carbon::now();
            $requisition->status = 'approved';
            $requisition->save();
        }
        if ($request->type == 'stocked') {
            $collected_qty = $request->collected_quantities;
            $ids = $request->ids;

            $collected_quantity = 0;
            $collect_wise_price = 0;
            for ($i = 0; $i < count($ids); $i++) {
                $reqItem = RequisitionItem::find($ids[$i]);
                $reqItem->collected_qty = $collected_qty[$reqItem->id];
                $reqItem->editedBy_id = Auth::id();
                $reqItem->save();
                $collected_quantity += $reqItem->collected_qty;
                $collect_wise_price += $reqItem->collected_qty *  $reqItem->final_price;
            }
            $requisition->collected_qty = $collected_quantity;
            $requisition->collect_wise_price = $collect_wise_price;
            $requisition->save();


            foreach ($requisition->requisition_items as $rqItem) {
                // Supplier Payment
                $rqItem->supplier()->increment('total_phrases_amount', $rqItem->collected_qty * $rqItem->final_price);


                if ($rqItem->type == 'pack') {
                    $previous_raw_stock = RawStock::where('raw_id', $rqItem->raw_id)->where('raw_cat_id', $rqItem->raw_cat_id)->where('pack_cat_id', $reqItem->pack_cat_id)->first();
                } else {
                    $previous_raw_stock = RawStock::where('raw_id', $rqItem->raw_id)->first();
                }

                if ($requisition->type == 'pack') {
                    if (($previous_raw_stock) &&  ($rqItem->price == $previous_raw_stock->unit_price)) {
                        $previous_raw_stock->total_quantity = $previous_raw_stock->total_quantity + $rqItem->collected_qty;
                        $previous_raw_stock->save();
                    } else {
                        $raw_stock = new RawStock;
                        $raw_stock->requisition_id = $requisition->id;
                        $raw_stock->requisition_item_id = $rqItem->id;
                        $raw_stock->total_quantity = $rqItem->collected_qty;
                        $raw_stock->unit_price = $rqItem->price;
                        $raw_stock->vat = $rqItem->vat;
                        $raw_stock->vat_price = $rqItem->vat_price;
                        $raw_stock->final_price = $rqItem->final_price;
                        $raw_stock->raw_id = $rqItem->raw_id;
                        $raw_stock->category_id = $rqItem->category_id;
                        $raw_stock->supplier_id = $rqItem->supplier_id;
                        $raw_stock->type = $rqItem->raw_type;
                        $raw_stock->addedBy_id = Auth::id();
                        $raw_stock->raw_cat_id = $rqItem->raw_cat_id;
                        $raw_stock->dhpl_cat_id = $rqItem->dhpl_cat_id;
                        $raw_stock->pack_cat_id = $rqItem->pack_cat_id;
                        $raw_stock->product_id = $rqItem->product_id;
                        $raw_stock->product_name = $rqItem->product_name;
                        $raw_stock->unit = $rqItem->unit;
                        $raw_stock->unit_value = $rqItem->unit_value;
                        $raw_stock->save();
                    }
                } else {
                    if (($previous_raw_stock) && ($rqItem->raw_id == $previous_raw_stock->raw_id) && ($rqItem->price == $previous_raw_stock->unit_price)) {
                        $previous_raw_stock->total_quantity = $previous_raw_stock->total_quantity + $rqItem->collected_qty;
                        $previous_raw_stock->save();
                    } else {
                        $raw_stock = new RawStock;
                        $raw_stock->requisition_id = $requisition->id;
                        $raw_stock->requisition_item_id = $rqItem->id;
                        $raw_stock->total_quantity = $rqItem->collected_qty;
                        $raw_stock->unit_price = $rqItem->price;
                        $raw_stock->vat = $rqItem->vat;
                        $raw_stock->vat_price = $rqItem->vat_price;
                        $raw_stock->final_price = $rqItem->final_price;
                        $raw_stock->raw_id = $rqItem->raw_id;
                        $raw_stock->category_id = $rqItem->category_id;
                        $raw_stock->supplier_id = $rqItem->supplier_id;
                        $raw_stock->type = $rqItem->raw_type;
                        $raw_stock->addedBy_id = Auth::id();
                        $raw_stock->unit = $rqItem->raw_materials->unit;
                        $raw_stock->unit_value = $rqItem->raw_materials->unit_value;
                        $raw_stock->save();
                    }
                }

                $requisition->stocked_at = Carbon::now();
                $requisition->status = 'stocked';
                $requisition->save();
            }
        }

        return redirect()->back()->with('success', "Requisition Successfully $request->type");
    }


    //Product Manufucturing

    public function productManufacturing(Request $request)
    {

        $status = $request->type;
        menuSubmenu('product', $status . 'Product');
        if ($request->type == 'all') {
            $products = Product::with('product_materials')->where('status', '!=', 'temp')->latest()->paginate(30);
        } elseif ($status == 'packaging') {
            $products = AfterProccessProduct::where('status', 'packaging')->get();
            return view('factoryManager.productManufacturing.afterProccessProductManufacturing', compact('products', 'status'));
        } elseif ($status == 'in_stocked') {
            $products = AfterProccessProduct::where('status', 'in_stocked')->groupBy('product_id')->groupBy('unit')->groupBy('unit_value')->latest()->paginate(30);
            return view('factoryManager.productManufacturing.afterProccessProductManufacturing', compact('products', 'status'));
        } else {
            $products = Product::with('product_materials')
                ->where('status', '!=', 'temp')
                ->where('status', $status)
                ->latest()
                ->paginate(30);
        }

        // $status = $request->type;
        // menuSubmenu('product', $status . 'Product');
        // if ($request->type == 'all') {
        //     $products = Product::with('product_materials')->where('status', '!=', 'temp')->latest()->paginate(30);
        // } else {
        //     $products = Product::with('product_materials')
        //         ->where('status', '!=', 'temp')
        //         ->where('status', $status)
        //         ->latest()
        //         ->paginate(30);
        // }
        return view('factoryManager.productManufacturing.productManufacturing', compact('products', 'status'));
    }

    public function viewProductManufacturing(Product $product, Request $request)
    {
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        $product = Product::where('id', $product->id)->with('product_materials')->first();
        return view('factoryManager.productManufacturing.viewProductManufacturing', compact('product', 'samples'));
    }
    public function editProductManufacturing(Product $product, Request $request)
    {
        if ($product->status != 'pending') {
            return redirect()->back()->with("warning", "You are not able to edit this product. because, This product status is {$product->status}");
        }

        // $product = $product->with('product_materials')->first();
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        return view('factoryManager.productManufacturing.editProductManufacturing', compact('product', 'samples'));
    }

    public function updateProductManufacturing(Product $product, Request $request)
    {

        if ($request->status == 'update') {
            if ($product->status != 'pending') {
                return redirect()->back()->with("warning", "We are not able to update this product. Because, this product is {$product->status}");
            }

            if (!$request->multiply) {
                return redirect()->back()->with('warning', 'Must Input Quantity');
            }
            $product->multiply_qty = $request->multiply;
            $product->save();

            foreach ($product->sample->sample_items as $key => $sampleItem) {
                $totalBatchQuantity = 0;
                if ($sampleItem->raw->firstBatch()) {
                    $totalBatchQuantity += $sampleItem->raw->firstBatch()->total_quantity;
                }
                if ($sampleItem->raw->secondBatch()) {
                    $totalBatchQuantity += $sampleItem->raw->secondBatch()->total_quantity;
                }
                if ($sampleItem->raw->thirdBatch()) {
                    $totalBatchQuantity += $sampleItem->raw->thirdBatch()->total_quantity;
                }
                if ($request->multiply > $totalBatchQuantity) {
                    return redirect()->back()->with('warning', 'We do not have the Quantity that you provided');
                }
                $totalBatchQuantity = 0;
            }

            if ($product->product_materials) {
                $product->product_materials()->delete();
            }
            $product->sample_name = $product->sample->name;
            $product->sample_unit = $product->sample->unit;
            $product->sample_unit_value = $product->sample->unit_value;
            $product->sample_unit_price = $request->sample_unit_price;
            $product->sample_total_price = $request->sample_total_price;
            $product->status = 'pending';
            $product->pending_at = Carbon::now();


            $product->name = $request->name;
            $product->unit = $request->unit;
            $product->unit_value = $request->unit_value;
            $product->unit_price = $request->unit_price;
            // $product->total_price = $request->total_price;
            $product->multiply_qty = $request->multiply;
            $product->save();

            $stock_ids = $request->stock;
            $quantities = $request->quantity;
            $total_raw_quanity = 0;
            $total_raw_price = 0;
            for ($i = 0; $i < count($stock_ids); $i++) {
                $stock = RawStock::find($stock_ids[$i]);

                $product_material = new ProductMaterial;
                $product_material->product_id = $product->id;
                $product_material->stock_id = $stock->id;
                $product_material->raw_id = $stock->raw_id;
                $product_material->type = 'raw';
                $product_material->unit_price = $stock->final_price;
                $product_material->unit = $stock->unit;
                $product_material->total_price = $stock->final_price * $quantities[$i];
                $product_material->quantity = (int) $quantities[$i];
                $product_material->save();

                $total_raw_quanity += $product_material->quantity;
                $total_raw_price += $product_material->quantity * $product_material->unit_price;
            }
            $product->total_raw_quantity = $total_raw_quanity;
            $product->total_raw_price = $total_raw_price;
            $product->total_price = $total_raw_price;
            $product->save();
            return redirect()->back()->with('success', 'Product Successfully Updated');
        }


        if ($request->status == 'confirm') {

            if ($request->confirm == 'confirm') {
                foreach ($product->product_materials as $key => $product_material) {
                    $product_material->stock->decrement('total_quantity', $product_material->quantity);
                }
                $product->status = 'confirmed';
                $product->confirmed_at = Carbon::now();
                $product->save();
            } else {
                $product->status = 'rejected';
                $product->rejected_at = Carbon::now();
                $product->save();
            }

            return redirect()->route('factory.productManufacturing', ['type' => $product->status])->with('success', "Product Successfully {$product->status}");
        }

        if ($request->status == 'in_stocked') {
            $product->status = 'in_stocked';
            $product->in_stocked = Carbon::now();
            $product->save();
            return redirect()->route('factory.productManufacturing', ['type' => 'in_stocked'])->with('success', 'Product Stocked in Successfully');
        }
    }
}
