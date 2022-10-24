<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\AfterProccessProduct;
use App\Models\AfterProccessProductMaterial;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Raw;
use App\Models\Sample;
use Illuminate\Http\Request;
use App\Models\RawStock;
use App\Models\SampleItem;
use App\Models\TempPackagingMandotoryItem;
use App\Models\TempPackagingMandotoryItemLists;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class ProductManufacturController extends Controller
{
    public function productManufacturing(Request $request)
    {
        $status = $request->type;
        menuSubmenu('product', $status . 'Product');

        $status = $request->type;
        menuSubmenu('product', $status . 'Product');
        if ($request->type == 'all') {
            $products = Product::with('product_materials')->where('status', '!=', 'temp')->latest()->paginate(30);
        } elseif ($status == 'packaging') {
            $products = AfterProccessProduct::where('status', 'packaging')->get();
            return view('production.productManufacturing.afterProccessProductManufacturing', compact('products', 'status'));
        } elseif ($status == 'in_stocked') {
            $products = AfterProccessProduct::where('status', 'in_stocked')->groupBy('product_id')->groupBy('unit')->groupBy('unit_value')->latest()->paginate(30);;

            return view('production.productManufacturing.afterProccessProductManufacturing', compact('products', 'status'));
        } else {
            $products = Product::with('product_materials')
                ->where('status', '!=', 'temp')
                ->where('status', $status)
                ->latest()
                ->paginate(30);
        }

        // if ($request->type == 'all') {

        //     $products = Product::with('product_materials')->where('status', '!=', 'temp')->paginate(30);
        // } else {
        //     $products = Product::with('product_materials')
        //         ->where('status', '!=', 'temp')
        //         ->where('status', $status)
        //         ->paginate(30);
        // }

        return view('production.productManufacturing.productManufacturing', compact('products', 'status'));
    }

    public function AddProductManufacturing()
    {
        $product = Product::where('status', 'temp')->first();
        if (!$product) {
            $product = new Product;
            $product->status = 'temp';
            $product->addedBy_id = Auth::id();
            $product->save();
        }
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        return view('production.productManufacturing.newProductManufacturing', compact('samples', 'product'));
    }

    public function productManufacturingAjax(Request $request, Product $product)
    {
        $product->sample_id = $request->id;
        $product->save();
        $sample_items = SampleItem::where('sample_id', $request->id)->get();

        return view('production.productManufacturing.ajax.appendSampleItems', compact('sample_items', 'product'))->render();
    }
    public function productManufacturingCalculateAjax(Request $request, Product $product)
    {
        $multiply = $request->multiply;
        $sample_unti = $request->sample_unit;
        $type = $request->user_type;
        if ($type) {
            $type = $request->user_type;
        } else {
            $type = 'admin';
        }
        return view('production.productManufacturing.ajax.appendSampleItemsWithCalculate', compact('product', 'multiply', 'sample_unti', 'type'))->render();
    }
    public function storeProductManufacturing(Product $product, Request $request)
    {
        if (!$request->multiply) {
            return redirect()->back()->with('warning', 'Must Input Quantity');
        }
        $product->multiply_qty = $request->multiply_qty;
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
                return redirect()->back()->with('warning', 'We do not have the quality you provided');
            }
            $totalBatchQuantity = 0;
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
            $product_material->type = 'raw';
            $product_material->raw_id = $stock->raw_id;
            $product_material->unit_price = $stock->unit_price;
            $product_material->unit = $stock->unit;
            $product_material->total_price = $stock->unit_price * $quantities[$i];
            $product_material->quantity = (int) $quantities[$i];
            $product_material->save();

            $total_raw_quanity += $product_material->quantity;
            $total_raw_price += $product_material->quantity * $product_material->unit_price;
            // $stock->decrement('total_quantity', $product_material->quantity);
            // $stock->save();
            // dump($quantities[$i]);
            // dump($product_material->quantity);
            // dump($product_material->stock_id);
        }
        $product->total_raw_quantity = $total_raw_quanity;
        $product->total_raw_price = $total_raw_price;
        $product->total_price = $total_raw_price;
        $product->save();

        return redirect()->route('production.productManufacturing', ['type' => 'pending'])->with('success', 'Product Successfully Added');
    }

    public function deleteProductManufacturing(Product $product)
    {
        if ($product->status != 'pending') {
            return redirect()->back()->with("warning", "You are not able to delete this product, Because this product is {$product->status}");
        }
        foreach ($product->product_materials as $key => $item) {
            $item->stock()->increment('total_quantity', $item->quantity);
            $item->delete();
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product successfully Deleted');
    }
    public function viewProductManufacturing(Product $product, Request $request)
    {
        // $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        // $product = Product::where('id', $request->product)->with('product_materials')->first();
        // if ($product->status == 'processing') {
        //     $packaging = Raw::where('type', 'pack')->orderBy('name')->get();
        //     return view('production.productManufacturing.viewProductManufacturing', compact('product', 'samples', 'packaging'));
        // }
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        $packaging_category = RawStock::where('type', 'pack')->groupBy('category_id')->get();

        $dhpl_product_id = $product->sample->dhpl_product_id;

        $mendotoryPack = RawStock::whereHas('raw', function ($q) use ($dhpl_product_id) {
            $q->where('product_id', $dhpl_product_id);
            $q->where('mandatory', true);
        })
            ->get();

        $optionalPack = RawStock::whereHas('raw', function ($q) use ($dhpl_product_id) {
            $q->where('product_id', $dhpl_product_id);
            $q->where('mandatory', false);
        })
            ->get();

        // if ($product->status = 'packaging') {
        //     $temp = new TempPackagingMandotoryItem;
        //     $temp->product_id = $product->id;
        //     $temp->user_id = Auth::id();
        //     $temp->save();
        // }
        foreach ($product->tempPackagingItems as $temp) {
            $temp->items()->delete();
            $temp->delete();
        }

        foreach ($mendotoryPack as $key => $mp) {
            $temp_pack = new TempPackagingMandotoryItem;
            $temp_pack->product_id = $product->id;
            $temp_pack->stock_id = $mp->id;
            $temp_pack->qty = 0;
            $temp_pack->user_id = Auth::id();
            $temp_pack->save();

            foreach ($optionalPack as $key => $op) {
                $team_pack_list = new TempPackagingMandotoryItemLists;
                $team_pack_list->temp_packaging_id = $temp_pack->id;
                $team_pack_list->stock_id = $op->id;
                $team_pack_list->checked = false;
                $team_pack_list->qty = 0;
                $team_pack_list->save();
            }
        }
        $temp_packs = TempPackagingMandotoryItem::with('items', 'stock')->where('user_id', Auth::id())->where('product_id', $product->id)->get();

        return view('production.productManufacturing.viewProductManufacturing', compact('product', 'samples', 'mendotoryPack', 'optionalPack', 'temp_packs'));
    }

    public function editProductManufacturing(Product $product, Request $request)
    {
        //         dd($product);
        //         $product = $product->with('product_materials')->first();
        // dd($product);
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        return view('production.productManufacturing.editProductManufacturing', compact('product', 'samples'));
    }



    public function editProductManufacturingAjax(Product $product, Request $request)
    {
        // $product->sample_id = $request->sample_id;
        // $product->save();
        $multiply = $request->multiply;
        if ($multiply == $product->multiply_qty) {
            $status = 'same';
            return view('production.productManufacturing.ajax.edit.isSame', compact('product', 'status'))->render();
        }
        if ($request->multiply < $product->multiply_qty) {
            $status = 'less';
            return view('production.productManufacturing.ajax.edit.isLess', compact('product', 'multiply', 'status'))->render();
        }
        if ($request->multiply > $product->multiply_qty) {
            $status = 'less';
            return 'beshi';
        }
    }
    public function updateProductManufacturing(Product $product, Request $request)
    {
        // $product = Product::find($request->product);
        // dd($request->all());

        if ($request->status == 'update') {
            $request->validate([
                'multiply' => 'required|min:1',
                'sample' => 'required',
                'sample_unit' => 'required',
            ]);

            if ($product->status != 'pending') {
                return redirect()->back()->with("warning", "We are not able to update this product. Because, this product is {$product->status}");
            }
            if (!$request->multiply) {
                return redirect()->back()->with('warning', 'Must Input Quantity');
            }
            $product->multiply_qty = $request->multiply_qty;
            $product->save();

            $multiply = $request->multiply;
            foreach ($product->sample->sample_items as $key => $sampleItem) {
                $fb_unit = strtolower($sampleItem->raw->firstBatch()->raw->unit);
                if ($fb_unit != $sampleItem->unit) {
                    if ($sampleItem->unit == 'kg') {
                        $fb_qty = kTg($sampleItem->unit_value) * $multiply;
                    } elseif ($sampleItem->unit == 'gm') {
                        $fb_qty = gTk($sampleItem->unit_value) * $multiply;
                    } elseif ($sampleItem->unit == 'ml') {
                        $fb_qty = mTl($sampleItem->unit_value) * $multiply;
                    } elseif ($sampleItem->unit == 'lt') {
                        $fb_qty = lTm($sampleItem->unit_value) * $multiply;
                    }
                } else {
                    $fb_qty = $sampleItem->unit_value * $multiply;
                }
                if ($sampleItem->raw->totalBatchQuantity() < $fb_qty) {
                    return redirect()->back()->with('warning', 'We do not have the quality you provided');
                }
            }
            if ($product->product_materials) {
                $product->product_materials()->delete();
            }

            $product->name = $request->name;
            $product->multiply_qty = $request->multiply;
            $product->unit = $request->unit;
            $product->unit_value = $request->unit_value;
            $product->unit_price = $request->unit_price;
            $product->total_price = $request->total_price;

            $product->sample_name = $product->sample->name;
            $product->sample_unit = $request->sample_unit;
            $product->sample_unit_value = $product->sample->unit_value;
            $product->status = 'pending';
            $product->pending_at = Carbon::now();


            $stock_ids = $request->stock;
            $quantities = $request->quantity;
            $total_raw_quanity = 0;
            $total_raw_price = 0;

            for ($i = 0; $i < count($stock_ids); $i++) {
                $stock = RawStock::find($stock_ids[$i]);

                $product_material = new ProductMaterial;
                $product_material->product_id = $product->id;
                $product_material->stock_id = $stock->id;
                $product_material->type = 'raw';
                $product_material->raw_id = $stock->raw_id;
                $product_material->unit_price = $stock->unit_price;
                $product_material->unit = $stock->unit;
                $product_material->total_price = $stock->unit_price * $quantities[$stock->id];
                $product_material->quantity = $quantities[$stock->id];
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
                    if ($product_material->quantity > $product_material->stock->total_quantity) {
                        return redirect()->back()->with('warning', "Not enough quantity of {$product_material->raw->name}");
                    }
                }

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

            return redirect()->route('admin.productManufacturing', ['type' => $product->status])->with('success', "Product Successfully {$product->status}");
        }

        if ($request->status == 'processing') {
            $product->status = 'processing';
            $product->processing_at = Carbon::now();
            $product->save();
            return redirect()->route('admin.productManufacturing', ['type' => 'processing'])->with('Product packaging Now');
        }
        if ($request->status == 'packaging') {

            $temp_products = TempPackagingMandotoryItem::where('product_id', $product->id)
                ->where('user_id', Auth::id())
                ->where('qty', ">", 0)
                ->get();

            $total_temp_unit_value = 0;
            foreach ($temp_products as $tp) {
                $temp_unit = $tp->stock->raw->unit;
                $temp_unit_value = $tp->stock->raw->unit_value;
                $product_unit = $product->unit;
                if ($product_unit !=  $temp_unit) {
                    if ($product_unit == 'kg') {
                        $unit_value = kTg($temp_unit_value) * $tp->qty;
                    } elseif ($product_unit == 'gm') {
                        $unit_value = gTk($temp_unit_value) * $tp->qty;
                    } elseif ($product_unit == 'ml') {
                        $unit_value = mTl($temp_unit_value) * $tp->qty;
                    } elseif ($product_unit == 'ltr') {
                        $unit_value = lTm($temp_unit_value) * $tp->qty;
                    }
                    $total_temp_unit_value += $unit_value;
                } else {
                    $total_temp_unit_value += $temp_unit_value * $tp->qty;
                }
            }

            if ($total_temp_unit_value > $product->unit_value) {
                return redirect()->back()->with('warning', 'Does not have enough quantity');
            }

            foreach ($temp_products as $mp) {
                $mandetory_stock = RawStock::find($mp->stock_id);

                $after_proccess_product = new AfterProccessProduct;
                $after_proccess_product->product_id = $product->id;
                $after_proccess_product->packaging_quantity = $mp->qty;
                $after_proccess_product->status = 'packaging';
                $after_proccess_product->packaging_at = Carbon::now();
                $after_proccess_product->unit = $mandetory_stock->unit;
                $after_proccess_product->unit_value = $mandetory_stock->unit_value;
                $after_proccess_product->unit_price = $product->unit_price;
                $after_proccess_product->total_price = $product->unit_price * $mp->qty;
                $after_proccess_product->save();

                //Packaging  Items list Start
                $product_pack_item_price = 0;

                $after_proccess_product_materials = $mp->items()->where('checked', true)
                    ->where('qty', '!=', null)
                    ->where('temp_packaging_id', '!=', null)
                    ->get();
                // dd($after_proccess_product_materials);
                foreach ($after_proccess_product_materials as $op) {
                    $mandetory_product_material = new AfterProccessProductMaterial;
                    $mandetory_product_material->after_proccess_product_id = $after_proccess_product->id;
                    $mandetory_product_material->product_id = $product->id;
                    $mandetory_product_material->stock_id = $op->stock_id;
                    $mandetory_product_material->raw_id = $op->stock->raw->id;
                    $mandetory_product_material->unit_price = $op->stock->unit_price;
                    $mandetory_product_material->unit = $op->stock->unit;
                    $mandetory_product_material->unit_value = $op->stock->unit_value;
                    $mandetory_product_material->type = $op->stock->type;
                    $mandetory_product_material->quantity = $op->qty;
                    $mandetory_product_material->total_price = $mandetory_product_material->quantity * $mandetory_product_material->unit_price;

                    $product_pack_item_price += $mandetory_product_material->total_price;
                    $mandetory_product_material->save();

                    $stock = RawStock::find($op->stock_id);
                    $stock->decrement('total_quantity', $mandetory_product_material->quantity);
                }
                //Packaging  Items list Start
                $final_tota_price = $after_proccess_product->total_price + $product_pack_item_price;
                $final_unit_price = ($after_proccess_product->total_price + $product_pack_item_price) / $after_proccess_product->packaging_quantity;

                $after_proccess_product->total_price = $final_tota_price;
                $after_proccess_product->unit_price = $final_unit_price;

                $mandetory_stock->decrement('total_quantity', $after_proccess_product->packaging_quantity);
            }

            $product->decrement('unit_value', $total_temp_unit_value);



            return redirect()->route('production.productManufacturing', ['type' => 'packaging'])->with('success', 'Packaging Stock Added Successfully');



        }
        if ($request->status == 'ready_to_stock') {
            $product->status = 'ready_to_stock';
            $product->ready_to_stock = Carbon::now();
            $product->save();
            return redirect()->route('production.productManufacturing', ['type' => 'ready_to_stock'])->with('Product Ready For Stock');
        }
        if ($request->status == 'in_stocked') {
            $afterProssessingId = AfterProccessProduct::find($request->afterProssessingId);

            $afterProssessingId->status = 'in_stocked';
            $afterProssessingId->in_stocked = Carbon::now();
            $afterProssessingId->save();

            return redirect()->route('production.productManufacturing', ['type' => 'in_stocked'])->with('success', 'Product Stocked in Successfully');
        }
    }

    // public function updateProductManufacturing(Product $product, Request $request)
    // {
    //     // $product = Product::find($request->product);
    //     // dd($request->all());

    //     if ($request->status == 'update') {
    //         $request->validate([
    //             'multiply' => 'required|min:1',
    //             'sample' => 'required',
    //             'sample_unit' => 'required',
    //         ]);

    //         if ($product->status != 'pending') {
    //             return redirect()->back()->with("warning", "We are not able to update this product. Because, this product is {$product->status}");
    //         }
    //         if (!$request->multiply) {
    //             return redirect()->back()->with('warning', 'Must Input Quantity');
    //         }
    //         $product->multiply_qty = $request->multiply_qty;
    //         $product->save();

    //         $multiply = $request->multiply;
    //         foreach ($product->sample->sample_items as $key => $sampleItem) {
    //             $fb_unit = strtolower($sampleItem->raw->firstBatch()->raw->unit);
    //             if ($fb_unit != $sampleItem->unit) {
    //                 if ($sampleItem->unit == 'kg') {
    //                     $fb_qty = kTg($sampleItem->unit_value) * $multiply;
    //                 } elseif ($sampleItem->unit == 'gm') {
    //                     $fb_qty = gTk($sampleItem->unit_value) * $multiply;
    //                 } elseif ($sampleItem->unit == 'ml') {
    //                     $fb_qty = mTl($sampleItem->unit_value) * $multiply;
    //                 } elseif ($sampleItem->unit == 'lt') {
    //                     $fb_qty = lTm($sampleItem->unit_value) * $multiply;
    //                 }
    //             } else {
    //                 $fb_qty = $sampleItem->unit_value * $multiply;
    //             }
    //             if ($sampleItem->raw->totalBatchQuantity() < $fb_qty) {
    //                 return redirect()->back()->with('warning', 'We do not have the quality you provided');
    //             }
    //         }
    //         if ($product->product_materials) {
    //             $product->product_materials()->delete();
    //         }

    //         $product->name = $request->name;
    //         $product->multiply_qty = $request->multiply;
    //         $product->unit = $request->unit;
    //         $product->unit_value = $request->unit_value;
    //         $product->unit_price = $request->unit_price;
    //         $product->total_price = $request->total_price;

    //         $product->sample_name = $product->sample->name;
    //         $product->sample_unit = $request->sample_unit;
    //         $product->sample_unit_value = $product->sample->unit_value;
    //         $product->status = 'pending';
    //         $product->pending_at = Carbon::now();


    //         $stock_ids = $request->stock;
    //         $quantities = $request->quantity;
    //         $total_raw_quanity = 0;
    //         $total_raw_price = 0;

    //         for ($i = 0; $i < count($stock_ids); $i++) {
    //             $stock = RawStock::find($stock_ids[$i]);

    //             $product_material = new ProductMaterial;
    //             $product_material->product_id = $product->id;
    //             $product_material->stock_id = $stock->id;
    //             $product_material->type = 'raw';
    //             $product_material->raw_id = $stock->raw_id;
    //             $product_material->unit_price = $stock->unit_price;
    //             $product_material->unit = $stock->unit;
    //             $product_material->total_price = $stock->unit_price * $quantities[$stock->id];
    //             $product_material->quantity = $quantities[$stock->id];
    //             $product_material->save();

    //             $total_raw_quanity += $product_material->quantity;
    //             $total_raw_price += $product_material->quantity * $product_material->unit_price;
    //         }

    //         $product->total_raw_quantity = $total_raw_quanity;
    //         $product->total_raw_price = $total_raw_price;
    //         $product->total_price = $total_raw_price;
    //         $product->save();
    //         return redirect()->back()->with('success', 'Product Successfully Updated');
    //     }

    //     if ($request->status == 'confirm') {
    //         if ($request->confirm == 'confirm') {

    //             foreach ($product->product_materials as $key => $product_material) {
    //                 if ($product_material->quantity > $product_material->stock->total_quantity) {
    //                     return redirect()->back()->with('warning', "Not enough quantity of {$product_material->raw->name}");
    //                 }
    //             }

    //             foreach ($product->product_materials as $key => $product_material) {
    //                 $product_material->stock->decrement('total_quantity', $product_material->quantity);
    //             }


    //             $product->status = 'confirmed';
    //             $product->confirmed_at = Carbon::now();
    //             $product->save();
    //         } else {
    //             $product->status = 'rejected';
    //             $product->rejected_at = Carbon::now();
    //             $product->save();
    //         }

    //         return redirect()->route('admin.productManufacturing', ['type' => $product->status])->with('success', "Product Successfully {$product->status}");
    //     }

    //     if ($request->status == 'processing') {
    //         $product->status = 'processing';
    //         $product->processing_at = Carbon::now();
    //         $product->save();
    //         return redirect()->route('admin.productManufacturing', ['type' => 'processing'])->with('Product packaging Now');
    //     }
    //     if ($request->status == 'packaging') {

    //         $temp_products = TempPackagingMandotoryItem::where('product_id', $product->id)
    //             ->where('user_id', Auth::id())
    //             ->where('qty', ">", 0)
    //             ->get();


    //         $total_temp_unit_value = 0;
    //         foreach ($temp_products as $tp) {
    //             $temp_unit = $tp->stock->raw->unit;
    //             $temp_unit_value = $tp->stock->raw->unit_value;
    //             $product_unit = $product->unit;
    //             if ($product_unit !=  $temp_unit) {
    //                 if ($product_unit == 'kg') {
    //                     $unit_value = kTg($temp_unit_value) * $tp->qty;
    //                 } elseif ($product_unit == 'gm') {
    //                     $unit_value = gTk($temp_unit_value) * $tp->qty;
    //                 } elseif ($product_unit == 'ml') {
    //                     $unit_value = mTl($temp_unit_value) * $tp->qty;
    //                 } elseif ($product_unit == 'ltr') {
    //                     $unit_value = lTm($temp_unit_value) * $tp->qty;
    //                 }
    //                 $total_temp_unit_value += $unit_value;
    //             } else {
    //                 $total_temp_unit_value += $temp_unit_value * $tp->qty;
    //             }
    //         }

    //         if ($total_temp_unit_value > $product->unit_value) {
    //             return redirect()->back()->with('warning', 'Does not have enough quantity');
    //         }

    //         foreach ($temp_products as $mp) {
    //             $mandetory_stock = RawStock::find($mp->stock_id);

    //             $after_proccess_product = new AfterProccessProduct;
    //             $after_proccess_product->product_id = $product->id;
    //             $after_proccess_product->packaging_quantity = $mp->qty;
    //             $after_proccess_product->status = 'packaging';
    //             $after_proccess_product->packaging_at = Carbon::now();
    //             $after_proccess_product->unit = $mandetory_stock->unit;
    //             $after_proccess_product->unit_value = $mandetory_stock->unit_value;
    //             $after_proccess_product->unit_price = $product->unit_price;
    //             $after_proccess_product->total_price = $product->unit_price * $mp->qty;
    //             $after_proccess_product->save();

    //             //Packaging  Items list Start
    //             $product_pack_item_price = 0;

    //             $after_proccess_product_materials = $mp->items()->where('checked', true)
    //                 ->where('qty', '!=', null)
    //                 ->where('temp_packaging_id', '!=', null)
    //                 ->get();
    //             // dd($after_proccess_product_materials);
    //             foreach ($after_proccess_product_materials as $op) {
    //                 $mandetory_product_material = new AfterProccessProductMaterial;
    //                 $mandetory_product_material->after_proccess_product_id = $after_proccess_product->id;
    //                 $mandetory_product_material->product_id = $product->id;
    //                 $mandetory_product_material->stock_id = $op->stock_id;
    //                 $mandetory_product_material->raw_id = $op->stock->raw->id;
    //                 $mandetory_product_material->unit_price = $op->stock->unit_price;
    //                 $mandetory_product_material->unit = $op->stock->unit;
    //                 $mandetory_product_material->unit_value = $op->stock->unit_value;
    //                 $mandetory_product_material->type = $op->stock->type;
    //                 $mandetory_product_material->quantity = $op->qty;
    //                 $mandetory_product_material->total_price = $mandetory_product_material->quantity * $mandetory_product_material->unit_price;

    //                 $product_pack_item_price += $mandetory_product_material->total_price;
    //                 $mandetory_product_material->save();

    //                 $stock = RawStock::find($op->stock_id);
    //                 $stock->decrement('total_quantity', $mandetory_product_material->quantity);
    //             }
    //             //Packaging  Items list Start
    //             $final_tota_price = $after_proccess_product->total_price + $product_pack_item_price;
    //             $final_unit_price = ($after_proccess_product->total_price + $product_pack_item_price) / $after_proccess_product->packaging_quantity;

    //             $after_proccess_product->total_price = $final_tota_price;
    //             $after_proccess_product->unit_price = $final_unit_price;

    //             $mandetory_stock->decrement('total_quantity', $after_proccess_product->packaging_quantity);
    //         }

    //         $product->decrement('unit_value', $total_temp_unit_value);


    //         // return redirect()->back()->with('success', 'Product Packaging successfully');

    //         // foreach ($temp_products as $mp) {
    //         //     $packStock = RawStock::find($mp->stock_id);
    //         //     if (!$product->afterProccessPackagingProduct()) {
    //         //         $after_proccess_product = new AfterProccessProduct;
    //         //         $after_proccess_product->product_id = $product->id;
    //         //         $after_proccess_product->packaging_quantity = $total_temp_unit_value;
    //         //         $after_proccess_product->status = 'packaging';
    //         //         $after_proccess_product->packaging_at = Carbon::now();
    //         //         // $after_proccess_product->save();

    //         //         //For Packstock
    //         //         $mandetory_product_material = new AfterProccessProductMaterial;
    //         //         $mandetory_product_material->after_proccess_product_id = $after_proccess_product->id;
    //         //         $mandetory_product_material->product_id = $product->id;
    //         //         $mandetory_product_material->stock_id = $packStock->id;
    //         //         $mandetory_product_material->raw_id = $packStock->raw_id;
    //         //         $mandetory_product_material->unit_price = $packStock->unit_price;
    //         //         $mandetory_product_material->unit = $packStock->unit;
    //         //         $mandetory_product_material->unit_value = $packStock->unit_value;
    //         //         $mandetory_product_material->type = $packStock->type;
    //         //         $mandetory_product_material->quantity = $mp->qty;
    //         //         $mandetory_product_material->total_price = $mandetory_product_material->quantity * $mandetory_product_material->unit_price;
    //         //         // $mandetory_product_material->save();
    //         //         // $packStock->decrement('total_quantity', $mandetory_product_material->quantity);


    //         //         ///batch wise logic missing;
    //         //         ///batch wise logic missing;

    //         //         //For Packstock
    //         //         $total_pack_quantity = 0;
    //         //         $total_pack_price = 0;
    //         //         foreach ($mp->checked_items() as $op) {
    //         //             $stock = RawStock::find($op->stock_id);
    //         //             $stock->decrement('total_quantity', $ap_product_material->quantity);
    //         //         }



    //         //         foreach ($sockIds as $key => $id) {
    //         //             $stock = RawStock::find($id);
    //         //             if ($sock_qty[$key] <= $stock->total_quantity) {
    //         //                 $ap_product_material = new AfterProccessProductMaterial;
    //         //                 $ap_product_material->after_proccess_product_id = $after_proccess_product->id;
    //         //                 $ap_product_material->product_id = $product->id;
    //         //                 $ap_product_material->stock_id = $stock->id;
    //         //                 $ap_product_material->raw_id = $stock->raw_id;
    //         //                 $ap_product_material->unit_price = $stock->unit_price;
    //         //                 $ap_product_material->unit = $stock->unit;
    //         //                 $ap_product_material->type = $stock->type;
    //         //                 $ap_product_material->quantity = $sock_qty[$key];
    //         //                 $ap_product_material->total_price = $ap_product_material->quantity * $ap_product_material->unit_price;
    //         //                 $ap_product_material->save();
    //         //                 $stock->decrement('total_quantity', $ap_product_material->quantity);
    //         //                 $total_pack_quantity += $ap_product_material->unit_price;
    //         //                 $total_pack_price += $ap_product_material->unit_price * $ap_product_material->unit_price;
    //         //             }
    //         //         }
    //         //         $product->unit_value = $product->unit_value - $packStock->raw->unit_value * $m_qty;
    //         //         $product->packaging_unit_value = $product->packaging_unit_value + $packStock->raw->unit_value * $m_qty;
    //         //         // $product->save();
    //         //         $product->total_pack_quantity = $total_pack_quantity;
    //         //         $product->total_pack_price = $total_pack_price;
    //         //         $product->total_price = $product->total_price + $total_pack_price;
    //         //         $product->save();
    //         //     } else {
    //         //         $after_proccess_product = $product->afterProccessPackagingProduct();
    //         //         $after_proccess_product->product_id = $product->id;
    //         //         $after_proccess_product->packaging_quantity = ($packStock->raw->unit_value * $m_qty) + $after_proccess_product->packaging_quantity;
    //         //         $after_proccess_product->save();

    //         //         //For Packstock
    //         //         $mandetory_product_material = new AfterProccessProductMaterial;
    //         //         $mandetory_product_material->after_proccess_product_id = $after_proccess_product->id;
    //         //         $mandetory_product_material->product_id = $product->id;
    //         //         $mandetory_product_material->stock_id = $packStock->id;
    //         //         $mandetory_product_material->raw_id = $packStock->raw_id;
    //         //         $mandetory_product_material->unit_price = $packStock->unit_price;
    //         //         $mandetory_product_material->unit = $packStock->unit;
    //         //         $mandetory_product_material->unit_value = $packStock->unit_value;
    //         //         $mandetory_product_material->type = $packStock->type;
    //         //         $mandetory_product_material->quantity = $m_qty;
    //         //         $mandetory_product_material->total_price = $mandetory_product_material->quantity * $mandetory_product_material->unit_price;
    //         //         $mandetory_product_material->save();
    //         //         $packStock->decrement('total_quantity', $mandetory_product_material->quantity);
    //         //         //For Packstock

    //         //         $total_pack_quantity = 0;
    //         //         $total_pack_price = 0;
    //         //         foreach ($sockIds as $key => $id) {
    //         //             $stock = RawStock::find($id);
    //         //             if ($sock_qty[$key] <= $stock->total_quantity) {
    //         //                 $ap_product_material = new AfterProccessProductMaterial;
    //         //                 $ap_product_material->after_proccess_product_id = $after_proccess_product->id;
    //         //                 $ap_product_material->product_id = $product->id;
    //         //                 $ap_product_material->stock_id = $stock->id;
    //         //                 $ap_product_material->raw_id = $stock->raw_id;
    //         //                 $ap_product_material->unit_price = $stock->unit_price;
    //         //                 $ap_product_material->unit = $stock->unit;
    //         //                 $ap_product_material->type = $stock->type;
    //         //                 $ap_product_material->quantity = $sock_qty[$key];
    //         //                 $ap_product_material->total_price = $ap_product_material->quantity * $ap_product_material->unit_price;
    //         //                 $ap_product_material->save();
    //         //                 $stock->decrement('total_quantity', $ap_product_material->quantity);
    //         //                 $total_pack_quantity += $ap_product_material->unit_price;
    //         //                 $total_pack_price += $ap_product_material->unit_price * $ap_product_material->unit_price;
    //         //             }
    //         //         }
    //         //         $product->unit_value = $product->unit_value - $packStock->raw->unit_value * $m_qty;
    //         //         $product->packaging_unit_value = $product->packaging_unit_value + $packStock->raw->unit_value * $m_qty;
    //         //         // $product->save();
    //         //         $product->total_pack_quantity = $total_pack_quantity;
    //         //         $product->total_pack_price = $total_pack_price;
    //         //         $product->total_price = $product->total_price + $total_pack_price;
    //         //         $product->save();
    //         //     }
    //         // }


    //         // $packStock = RawStock::find($request->m_stock_id);
    //         // $m_qty = $request->m_qty;

    //         // $sockIds = $request->stock_id;
    //         // $sock_qty = $request->qty;
    //         // $unit_value = $request->unitValue;

    //         // if (($packStock->raw->unit_value * $m_qty) > $product->unit_value) {
    //         //     return redirect()->back()->with('success', 'Raw unit value getter then product unit Value');
    //         // } else {
    //         //     if (!$product->afterProccessPackagingProduct()) {
    //         //         $after_proccess_product = new AfterProccessProduct;
    //         //         $after_proccess_product->product_id = $product->id;
    //         //         $after_proccess_product->packaging_quantity = $packStock->raw->unit_value * $m_qty;
    //         //         $after_proccess_product->status = 'packaging';
    //         //         $after_proccess_product->packaging_at = Carbon::now();
    //         //         $after_proccess_product->save();

    //         //         //For Packstock
    //         //         $mandetory_product_material = new AfterProccessProductMaterial;
    //         //         $mandetory_product_material->after_proccess_product_id = $after_proccess_product->id;
    //         //         $mandetory_product_material->product_id = $product->id;
    //         //         $mandetory_product_material->stock_id = $packStock->id;
    //         //         $mandetory_product_material->raw_id = $packStock->raw_id;
    //         //         $mandetory_product_material->unit_price = $packStock->unit_price;
    //         //         $mandetory_product_material->unit = $packStock->unit;
    //         //         $mandetory_product_material->unit_value = $packStock->unit_value;
    //         //         $mandetory_product_material->type = $packStock->type;
    //         //         $mandetory_product_material->quantity = $m_qty;
    //         //         $mandetory_product_material->total_price = $mandetory_product_material->quantity * $mandetory_product_material->unit_price;
    //         //         $mandetory_product_material->save();
    //         //         $packStock->decrement('total_quantity', $mandetory_product_material->quantity);
    //         //         //For Packstock

    //         //         $total_pack_quantity = 0;
    //         //         $total_pack_price = 0;
    //         //         foreach ($sockIds as $key => $id) {
    //         //             $stock = RawStock::find($id);
    //         //             if ($sock_qty[$key] <= $stock->total_quantity) {
    //         //                 $ap_product_material = new AfterProccessProductMaterial;
    //         //                 $ap_product_material->after_proccess_product_id = $after_proccess_product->id;
    //         //                 $ap_product_material->product_id = $product->id;
    //         //                 $ap_product_material->stock_id = $stock->id;
    //         //                 $ap_product_material->raw_id = $stock->raw_id;
    //         //                 $ap_product_material->unit_price = $stock->unit_price;
    //         //                 $ap_product_material->unit = $stock->unit;
    //         //                 $ap_product_material->type = $stock->type;
    //         //                 $ap_product_material->quantity = $sock_qty[$key];
    //         //                 $ap_product_material->total_price = $ap_product_material->quantity * $ap_product_material->unit_price;
    //         //                 $ap_product_material->save();
    //         //                 $stock->decrement('total_quantity', $ap_product_material->quantity);
    //         //                 $total_pack_quantity += $ap_product_material->unit_price;
    //         //                 $total_pack_price += $ap_product_material->unit_price * $ap_product_material->unit_price;
    //         //             }
    //         //         }
    //         //         $product->unit_value = $product->unit_value - $packStock->raw->unit_value * $m_qty;
    //         //         $product->packaging_unit_value = $product->packaging_unit_value + $packStock->raw->unit_value * $m_qty;
    //         //         // $product->save();
    //         //         $product->total_pack_quantity = $total_pack_quantity;
    //         //         $product->total_pack_price = $total_pack_price;
    //         //         $product->total_price = $product->total_price + $total_pack_price;
    //         //         $product->save();
    //         //     } else {
    //         //         $after_proccess_product = $product->afterProccessPackagingProduct();
    //         //         $after_proccess_product->product_id = $product->id;
    //         //         $after_proccess_product->packaging_quantity = ($packStock->raw->unit_value * $m_qty) + $after_proccess_product->packaging_quantity;
    //         //         $after_proccess_product->save();

    //         //         //For Packstock
    //         //         $mandetory_product_material = new AfterProccessProductMaterial;
    //         //         $mandetory_product_material->after_proccess_product_id = $after_proccess_product->id;
    //         //         $mandetory_product_material->product_id = $product->id;
    //         //         $mandetory_product_material->stock_id = $packStock->id;
    //         //         $mandetory_product_material->raw_id = $packStock->raw_id;
    //         //         $mandetory_product_material->unit_price = $packStock->unit_price;
    //         //         $mandetory_product_material->unit = $packStock->unit;
    //         //         $mandetory_product_material->unit_value = $packStock->unit_value;
    //         //         $mandetory_product_material->type = $packStock->type;
    //         //         $mandetory_product_material->quantity = $m_qty;
    //         //         $mandetory_product_material->total_price = $mandetory_product_material->quantity * $mandetory_product_material->unit_price;
    //         //         $mandetory_product_material->save();
    //         //         $packStock->decrement('total_quantity', $mandetory_product_material->quantity);
    //         //         //For Packstock

    //         //         $total_pack_quantity = 0;
    //         //         $total_pack_price = 0;
    //         //         foreach ($sockIds as $key => $id) {
    //         //             $stock = RawStock::find($id);
    //         //             if ($sock_qty[$key] <= $stock->total_quantity) {
    //         //                 $ap_product_material = new AfterProccessProductMaterial;
    //         //                 $ap_product_material->after_proccess_product_id = $after_proccess_product->id;
    //         //                 $ap_product_material->product_id = $product->id;
    //         //                 $ap_product_material->stock_id = $stock->id;
    //         //                 $ap_product_material->raw_id = $stock->raw_id;
    //         //                 $ap_product_material->unit_price = $stock->unit_price;
    //         //                 $ap_product_material->unit = $stock->unit;
    //         //                 $ap_product_material->type = $stock->type;
    //         //                 $ap_product_material->quantity = $sock_qty[$key];
    //         //                 $ap_product_material->total_price = $ap_product_material->quantity * $ap_product_material->unit_price;
    //         //                 $ap_product_material->save();
    //         //                 $stock->decrement('total_quantity', $ap_product_material->quantity);
    //         //                 $total_pack_quantity += $ap_product_material->unit_price;
    //         //                 $total_pack_price += $ap_product_material->unit_price * $ap_product_material->unit_price;
    //         //             }
    //         //         }
    //         //         $product->unit_value = $product->unit_value - $packStock->raw->unit_value * $m_qty;
    //         //         $product->packaging_unit_value = $product->packaging_unit_value + $packStock->raw->unit_value * $m_qty;
    //         //         // $product->save();
    //         //         $product->total_pack_quantity = $total_pack_quantity;
    //         //         $product->total_pack_price = $total_pack_price;
    //         //         $product->total_price = $product->total_price + $total_pack_price;
    //         //         $product->save();
    //         //     }
    //         // }
    //         return redirect()->route('admin.productManufacturing', ['type' => 'packaging'])->with('success', 'Packaging Stock Added Successfully');


    //         // dd($request->all());
    //         // if (!$request->pack_material) {
    //         //     return redirect()->back()->with('error', 'Must Select Packaging');
    //         // }
    //         // $raw_pack_ids = $request->pack_material;
    //         // $pack_quantity = $request->pack_quantity;

    //         // $total_pack_quantity = 0;
    //         // $total_pack_price = 0;
    //         // foreach ($raw_pack_ids as $key => $pack_raw_qty) {
    //         //     $pack_raw = Raw::find($pack_raw_qty);
    //         //     $req_pack_quantity = $pack_quantity[$key];

    //         //     if ($pack_raw->hasRawStocks()) {
    //         //         if ($pack_raw->totalBatchQuantity() < $req_pack_quantity) {
    //         //             return redirect()->back()->with('warning', 'not enough Quantity');
    //         //         }
    //         //     }
    //         //     foreach ($request->stock[$pack_raw_qty] as $key => $value) {
    //         //         $qty = $request->quantity[$pack_raw_qty][$key];
    //         //         $pack_stock = RawStock::find($value);

    //         //         $product_material = new ProductMaterial;
    //         //         $product_material->product_id = $product->id;
    //         //         $product_material->stock_id = $pack_stock->id;
    //         //         $product_material->raw_id = $pack_raw->id;
    //         //         $product_material->unit_price = $pack_stock->unit_price;
    //         //         $product_material->unit = $pack_stock->unit;
    //         //         $product_material->type = $pack_stock->type;
    //         //         $product_material->quantity = $qty;
    //         //         $product_material->total_price = $product_material->quantity * $product_material->unit_price;
    //         //         $product_material->save();
    //         //         $pack_stock->decrement('total_quantity', $product_material->quantity);

    //         //         $total_pack_quantity += $product_material->unit_price;
    //         //         $total_pack_price += $product_material->unit_price * $product_material->unit_price;
    //         //     }
    //         // }

    //         // $product->status = 'packaging';
    //         // $product->packaging_at = Carbon::now();
    //         // $product->total_pack_quantity = $total_pack_quantity;
    //         // $product->total_pack_price = $total_pack_price;
    //         // $product->total_price = $product->total_price + $total_pack_price;
    //         // $product->save();
    //         // return redirect()->route('admin.productManufacturing', ['type' => 'packaging'])->with('success', 'Packaging Stock Added Successfully');
    //         // return redirect()->route('admin.productManufacturing', ['type' => 'packaging'])->with('Product packaging Now');
    //     }
    //     if ($request->status == 'ready_to_stock') {
    //         $product->status = 'ready_to_stock';
    //         $product->ready_to_stock = Carbon::now();
    //         $product->save();
    //         return redirect()->route('admin.productManufacturing', ['type' => 'ready_to_stock'])->with('Product Ready For Stock');
    //     }
    //     if ($request->status == 'in_stocked') {
    //         $afterProssessingId = AfterProccessProduct::find($request->afterProssessingId);
    //         // $prev_product = AfterProccessProduct::where('product_id', $product->id)->first();
    //         // if (($prev_product) && ($prev_product->unit_price == $afterProssessingId->unit_price) && ($prev_product->product_id == $afterProssessingId->product_id)) {
    //         //     dd("Same");
    //         //     $afterProssessingId->packaging_quantity = $afterProssessingId->packaging_quantity + $prev_product->packaging_quantity;
    //         //     $afterProssessingId->status = 'in_stocked';
    //         //     $afterProssessingId->in_stocked = Carbon::now();
    //         //     $afterProssessingId->save();
    //         // } else {
    //         //     dd("NOt Same");
    //         //     $afterProssessingId->status = 'in_stocked';
    //         //     $afterProssessingId->in_stocked = Carbon::now();
    //         //     $afterProssessingId->save();
    //         // }
    //         $afterProssessingId->status = 'in_stocked';
    //         $afterProssessingId->in_stocked = Carbon::now();
    //         $afterProssessingId->save();

    //         return redirect()->route('admin.productManufacturing', ['type' => 'in_stocked'])->with('success', 'Product Stocked in Successfully');
    //     }
    // }
    public function viewProductManufacturingAfterProccess(Request $request)
    {

        $after_proccess_product = AfterProccessProduct::find($request->product);
        $samples = Sample::where('active', true)->orderBy('id', 'DESC')->get();
        // dd($product->afterProccessPackagingProduct());
        $product =  $after_proccess_product->product;

        return view('production.productManufacturing.viewAfterProccessProductManufacturing', compact('product', 'after_proccess_product', 'samples'));
    }
}
