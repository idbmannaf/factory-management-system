<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PackReqTemp;
use App\Models\Raw;
use App\Models\RawStock;
use App\Models\RawStockModifyHistory;
use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\Supplier;
use App\Models\WebsiteBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public $dhpl;
    public function __construct()
    {
        $this->dhpl = DB::connection('dhpl');
    }
    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function getChartData()
    {
        // dd(now()->subMonths(1)->format('M'));
        $pendingOrderCount = EcommerceOrder::where('order_status', 'pending')->count();
        $confirmedOrderCount = EcommerceOrder::where('order_status', 'confirmed')->count();
        $processingOrderCount = EcommerceOrder::where('order_status', 'processing')->count();
        $readyToShipOrderCount = EcommerceOrder::where('order_status', 'ready_to_ship')->count();
        $shippedOrderCount = EcommerceOrder::where('order_status', 'shipped')->count();
        $collectedOrderCount = EcommerceOrder::where('order_status', 'collected')->count();
        $deliveredOrderCount = EcommerceOrder::where('order_status', 'delivered')->count();
        $canceledOrderCount = EcommerceOrder::where('order_status', 'canceled')->count();
        $orderChartData = [
            'labels' => [
                'Pending',
                'Confirmed',
                'Prcessing',
                'Ready To Ship',
                'Shipped',
                'Collected',
                'Delivered',
                'Canceled',
            ],
            'datasets' => [
                [
                    'data' => [$pendingOrderCount, $confirmedOrderCount, $processingOrderCount, $readyToShipOrderCount, $shippedOrderCount, $collectedOrderCount, $deliveredOrderCount, $canceledOrderCount],

                    'backgroundColor' => ['#d2d6de', '#00c0ef', '#3c8dbc', '#ffeeaa', '#f39c12', '#f56954', '#00a65a', '#FF0000'],
                ]
            ],
        ];

        $thisMonthSale = SaleCommission::whereMonth('created_at', now()->month)->sum('collection_amount');
        $thisMonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->month)->sum('paid_amount');
        $prev1MonthSale = SaleCommission::whereMonth('created_at', now()->subMonths(1)->month)->sum('collection_amount');
        $prev1MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(1)->month)->sum('paid_amount');
        $prev2MonthSale = SaleCommission::whereMonth('created_at', now()->subMonths(2)->month)->sum('collection_amount');
        $prev2MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(2)->month)->sum('paid_amount');
        $prev3MonthSale = SaleCommission::whereMonth('created_at', now()->subMonths(3)->month)->sum('collection_amount');
        $prev3MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(3)->month)->sum('paid_amount');
        $prev4MonthSale = SaleCommission::whereMonth('created_at', now()->subMonths(4)->month)->sum('collection_amount');
        $prev4MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(4)->month)->sum('paid_amount');
        $prev5MonthSale = SaleCommission::whereMonth('created_at', now()->subMonths(5)->month)->sum('collection_amount');
        $prev5MonthCollection = EcommercePaymentCollection::whereMonth('created_at', now()->subMonths(5)->month)->sum('paid_amount');

        $paymentChartData = [
            'labels' => [now()->subMonths(5)->format('M'), now()->subMonths(4)->format('M'), now()->subMonths(3)->format('M'), now()->subMonths(2)->format('M'), now()->subMonths(1)->format('M'), now()->format('M')],
            'datasets' => [
                [
                    'label' => 'Monthly Payment Collection',
                    'backgroundColor' => 'rgba(210, 214, 222, 1)',
                    'borderColor' => 'rgba(210, 214, 222, 1)',
                    'pointRadius' => false,
                    'pointColor' => 'rgba(210, 214, 222, 1)',
                    'pointStrokeColor' => '#c1c7d1',
                    'pointHighlightFill' => '#fff',
                    'pointHighlightStroke' => 'rgba(220,220,220,1)',
                    'data' => [$prev5MonthCollection, $prev4MonthCollection, $prev3MonthCollection, $prev2MonthCollection, $prev1MonthCollection, $thisMonthCollection]
                ],
                [
                    'label' => 'Monthly Sales',
                    'backgroundColor' => 'rgba(60,141,188,0.9)',
                    'borderColor' => 'rgba(60,141,188,0.8)',
                    'pointRadius' => false,
                    'pointColor' => '#3b8bba',
                    'pointStrokeColor' => 'rgba(60,141,188,1)',
                    'pointHighlightFill' => '#fff',
                    'pointHighlightStroke' => 'rgba(60,141,188,1)',
                    'data' => [$prev5MonthSale, $prev4MonthSale, $prev3MonthSale, $prev2MonthSale, $prev1MonthSale, $thisMonthSale]
                ],
            ],
        ];

        $data = [
            'orderChartData' => $orderChartData,
            'paymentChartData' => $paymentChartData,
        ];

        return response()->json($data, 200);
    }

    public function materials(Request $request)
    {
        $type = $request->type;
        if ($type == 'raw') {
            menuSubmenu('Materials', 'RowMaterials');
            $rawMaterials = Raw::with('category')->where('type', $type)->orderBy('id', 'DESC')->paginate(30);
            $categories = Category::where('type', 'raw')->where('active', true)->get();
            return view('admin.materials.rawMaterials', compact('rawMaterials', 'categories'));
        }
        if ($type == 'pack') {
            menuSubmenu('Materials', 'PackagingMaterials');
            $packaging = Raw::with('medicine')->where('type', $type)->orderBy('category_id')->paginate(30);
            $categories = Category::where('type', 'pack')->where('active', true)->get();
            $medicine_types =$this->dhpl->table('ecommerce_categories')->get();
            //  Category::where('type', 'raw')->where('active', true)->get();
            return view('admin.materials.packaging', compact('packaging', 'categories','medicine_types'));
        }
        if ($type == 'stationery') {
            menuSubmenu('Materials', 'stationeryMaterials');
            $stationeries = Raw::where('type', $type)->with('category')->orderBy('id', 'DESC')->paginate(30);
            return view('admin.materials.stationeries', compact('stationeries', 'type'));
        }
    }

    public function addMaterials(Request $request)
    {
        if ($request->type == 'raw') {
            $request->validate([
                'name' => 'required',
                'unit' => 'required',
                'category' => 'required',
                'unit_value' => 'required',
                'active' => 'nullable',
            ]);
        }
        if ($request->type == 'stationery') {
            $request->validate([
                'name' => 'required',
                'unit' => 'required',
                'unit_value' => 'required',
                'active' => 'nullable',
            ]);
        }
        if ($request->type == 'pack') {
            $request->validate([
                'categories.*' => 'required',
                'medicine_type' => 'required',
                'active' => 'nullable',
            ]);
        }

        if ($request->type == 'raw') {
            $raw = new Raw;
            $raw->name = $request->name;
            $raw->type = $request->type;
            $raw->unit = $request->unit;
            $raw->category_id = $request->category;
            $raw->unit_value = $request->unit_value;
            $raw->active = $request->active ? 1 : 0;
            $raw->addedBy_id = Auth::id();
            $raw->save();
            return redirect()->back()->with('success', 'Materials Added Successfully');
        }
        if ($request->type == 'pack') {


            $oms_category = $this->dhpl->table('ecommerce_categories')->find($request->medicine_type);
            $oms_products = $this->dhpl->table('ecommerce_products')->where('category_id',  $oms_category->id)->get();
            foreach ($oms_products as  $product) {
                foreach ($request->categories as  $category) {
                    $category = Category::find($category);
                    $old_pack_raw = Raw::where('product_id', $product->id)->where('category_id', $category->id)->where('dhpl_cat_id', $oms_category->id)->first();
                    if (!$old_pack_raw) {
                        $pack = new Raw;
                        $pack->name ="(". $category->name."): ".json_decode($product->name)->en.": ".json_decode($oms_category->name)->en;
                        $pack->type = 'pack';
                        $pack->category_id = $category->id;
                        $pack->unit = $product->unit;
                        $pack->unit_value = $product->unit_value;
                        $pack->raw_cat_id = $category->id;
                        $pack->dhpl_cat_id = $oms_category->id;
                        $pack->product_id= $product->id;
                        $pack->product_name= json_decode($product->name)->en;
                        $pack->product_type= $product->type;
                        $pack->product_type_value= $product->type_value ?? 0.00;
                        $pack->active = $request->active ? 1 : 0;
                        $pack->addedBy_id = Auth::id();
                        if ($request->mendotory == '1') {
                            $pack->mandatory= 1;
                        }
                        if ($request->mendotory == '2') {
                            $pack->mandatory_qty= 1;
                        }

                        $pack->save();
                    }
                }
            }


            return redirect()->back()->with('success', 'Packing Added Successfully');
        }
        if ($request->type == 'stationery') {
            $stationery = new Raw;
            $stationery->name = $request->name;
            $stationery->type = 'stationery';
            $stationery->unit = $request->unit;
            $stationery->unit_value = $request->unit_value;
            $stationery->active = $request->active ? 1 : 0;
            $stationery->addedBy_id = Auth::id();
            $stationery->save();
            return redirect()->back()->with('success', 'Stationery Added Successfully');
        }
    }

    public function updateMaterials(Request $request)
    {

        if ($request->type == 'raw') {
            $request->validate([
                'name' => 'required',
                'unit' => 'required',
                'category' => 'required',
                'unit_value' => 'required',
                'active' => 'nullable',
                'mandatory' => 'nullable',
            ]);
        }
        if ($request->type == 'stationery') {
            $request->validate([
                'name' => 'required',
                'unit' => 'required',
                'unit_value' => 'required',
                'active' => 'nullable',
                'mandatory' => 'nullable',
            ]);
        }
        if ($request->type == 'pack') {
            $request->validate([
                'name' => 'required',
                'unit' => 'required',
                'unit_value' => 'required',
                'medicine_type' => 'required',
                'active' => 'nullable',
                'mandatory' => 'nullable',
            ]);
        }
        if ($request->type == 'raw') {
            $raw = Raw::where('id', $request->material)->where('type', 'raw')->first();
            $raw->name = $request->name;
            $raw->category_id = $request->category;
            $raw->type = $request->type;
            $raw->mandatory = $request->mandatory ? 1 :0;
            $raw->unit = $request->unit;
            $raw->unit_value = $request->unit_value;
            $raw->active = $request->active ? 1 : $raw->active;
            $raw->editedBy_id = Auth::id();
            $raw->save();
            return redirect()->back()->with('success', 'Materials Successfully Updated');
        }
        if ($request->type == 'pack') {
            $pack = Raw::where('id', $request->material)->where('type', 'pack')->first();
            $pack->name = $request->name;
            $pack->category_id = $request->category;
            $pack->dhpl_cat_id = $request->medicine_type;
            $pack->type = $request->type;
            $pack->unit = $request->unit;
            $pack->unit_value = $request->unit_value;
            $pack->mandatory = $request->mandatory ? 1 :0;
            $pack->active = $request->active ? 1 : $pack->active;
            $pack->editedBy_id = Auth::id();
            $pack->save();
            return redirect()->back()->with('success', 'Packing Successfully Updated');
        }
        if ($request->type == 'stationery') {
            $stationery = Raw::where('id', $request->material)->where('type', 'stationery')->first();
            $stationery->name = $request->name;
            $stationery->type = 'stationery';
            $stationery->unit = $request->unit;
            $stationery->unit_value = $request->unit_value;
            $stationery->active = $request->active ? 1 : $stationery->active;
            $stationery->editedBy_id = Auth::id();
            $stationery->save();
            return redirect()->back()->with('success', 'Stationery Added Updated');
        }
    }

    public function deleteMaterials(Request $request)
    {

        $material = Raw::find($request->material);
        if ($material->hasRawStocks()) {
            return redirect()->back()->with('warning', 'You are not able to Delete this Raw, Because this raw have in Raw Stocks');
        }
        $material->delete();
        if ($request->type == 'pack') {
            $msg = 'Pack Successfully';
        } else {
            $msg = 'Material Successfully Deleted';
        }

        return redirect()->back()->with('success', $msg);
    }


    public function requisitionList(Request $request)
    {
        $type = $request->type;
        menuSubmenu('requisition', $type);
        if ($type == 'all') {

            $requisitions = Requisition::orderByRaw("FIELD(status,'pending','collected','approved','stocked')")->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(20);
        } elseif ($type == 'pending') {
            $requisitions = Requisition::where('status', 'pending')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(20);
        } elseif ($type == 'approved') {
            $requisitions = Requisition::where('status', 'approved')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(20);
        } elseif ($type == 'purchase') {
            $requisitions = Requisition::where('status', 'purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'pending_purchase') {
            $requisitions = Requisition::where('status', 'pending_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'approved_purchase') {
            $requisitions = Requisition::where('status', 'approved_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'purchase') {
            $requisitions = Requisition::where('status', 'purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'collected') {
            $requisitions = Requisition::where('status', 'collected')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'stocked') {
            $requisitions = Requisition::where('status', 'stocked')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(20);
        } else {
            return back();
        }

        return view('admin.requisition.requisitionAll', compact('requisitions', 'type'));
    }
    public function requisitionView(Request $request)
    {

        $requisition = Requisition::with('requisition_items')->find($request->requisition);
        $suppliers  =  Supplier::where('active', true)->get();
        if (!$requisition) {
            return redirect()->back()->with('warning', 'Requisition Not Found');
        }

        return view('admin.requisition.viewRequisition', compact("requisition", "suppliers"));
    }
    public function requisitionDelete(Request $request)
    {
        $requisition = Requisition::find($request->requisition);
        if ($requisition->status == 'pending') {
            $requisition->requisition_items()->delete();
            $requisition->delete();
            return redirect()->back()->with('success', 'Requisition Successfully Deleted');
        } else {
            return back();
        }
    }
    public function requisitionEdit(Request $request)
    {
        menuSubmenu('requisitions', 'requisition');
        $requisition = Requisition::find($request->requisition);
        $rawMaterials = Raw::where('type', 'raw')->orderBy('name')->get();
        $packMaterials = Raw::where('type', 'pack')->orderBy('name')->get();
        $stationeryMaterials = Raw::where('type', 'stationery')->orderBy('name')->get();

        $suppliers = Supplier::where('active', true)->get();

        return view('admin.requisition.editRequisition', compact("requisition", "suppliers", 'packMaterials', "rawMaterials", 'stationeryMaterials'));
    }
    public function requisitionUpdate(Request $request)
    {

        $requisition = Requisition::find($request->requisition);
        $requisition->date = $request->date;
        $requisition->pending_at = Carbon::now();
        $requisition->user_id = Auth::id();
        $requisition->editedBy_id = Auth::id();
        $requisition->status = 'pending';
        $requisition->save();

        $requisition->requisition_items()->delete();

        $raw_material = $request->raw_material;
        $raw_suppliers = $request->raw_suppliers;
        $raw_quantity = $request->raw_quantity;
        $raw_price = $request->raw_price;

        $raw_total_quantity = 0;
        $raw_total_price = 0;
        if ($request->raw_material) {
            for ($i = 0; $i < count($request->raw_material); $i++) {
                $requisition_item = new RequisitionItem;
                $requisition_item->user_id = Auth::id();
                $requisition_item->requisition_id = $requisition->id;
                $requisition_item->quantity = $raw_quantity[$i];
                $requisition_item->price = $raw_price[$i];
                $requisition_item->raw_id = $raw_material[$i];
                $requisition_item->supplier_id = $raw_suppliers[$i];
                $requisition_item->addedBy_id = Auth::id();
                $requisition_item->raw_type = 'raw';
                $requisition_item->save();
                $raw_total_quantity += $requisition_item->quantity;
                $raw_total_price += $requisition_item->quantity * $requisition_item->price;
            }
        }

        $pack_material = $request->pack_material;
        $pack_suppliers = $request->pack_suppliers;
        $pack_quantity = $request->pack_quantity;
        $pack_price = $request->pack_price;

        $total_pack_quantity = 0;
        $total_pack_price = 0;
        if ($request->pack_material) {
            for ($i = 0; $i < count($request->pack_material); $i++) {
                $requisition_item = new RequisitionItem;
                $requisition_item->user_id = Auth::id();
                $requisition_item->requisition_id = $requisition->id;
                $requisition_item->quantity = $pack_quantity[$i];
                $requisition_item->price = $pack_price[$i];
                $requisition_item->raw_id = $pack_material[$i];
                $requisition_item->raw_type = 'pack';
                $requisition_item->supplier_id = $pack_suppliers[$i];
                $requisition_item->addedBy_id = Auth::id();
                $requisition_item->save();
                $total_pack_quantity += $requisition_item->quantity;
                $total_pack_price += $requisition_item->quantity * $requisition_item->price;
            }
        }
        $requisition->total_quantity = $raw_total_quantity + $total_pack_quantity;
        $requisition->total_price = $raw_total_price + $total_pack_price;
        $requisition->save();
        if ($request->type == "store") {
            return redirect()->route('production.requisitionAll')->with('success', 'Requisition Successfully Added');
        } else {
            return redirect()->back()->with('success', 'Requisition Successfully Updated');
        }
    }

    public function requisitionProcessUpdate(Request $request)
    {
        $requisition = Requisition::find($request->requisition);
        // if ($requisition->status != 'purchase' || $requisition->status != 'collected') {
        //     $request->validate([
        //         'suppliers.*' => 'required',
        //         'quantity.*' => 'required',
        //         'price.*' => 'required',
        //     ]);
        // }

        if ($requisition->status == $request->type) {
            return redirect()->back()->with('warning', "You have Already $request->type");
        }
        if ($request->type == 'approved') {
            $requisition->approved_at = Carbon::now();
            $requisition->status = 'approved';
            $requisition->save();

            // $ids = $request->id;
            // $suppliers = $request->suppliers;
            // $quantity = $request->quantity;
            // $price = $request->price;
            // $vat = $request->vat;
            // for ($i = 0; $i < count($ids); $i++) {
            //     $requisition_item = RequisitionItem::find($ids[$i]);
            //     $requisition_item->quantity = $quantity[$i];
            //     $requisition_item->supplier_id = $suppliers[$i];
            //     $requisition_item->price = $price[$i];
            //     $requisition_item->vat = $vat[$i] ?? 0;
            //     $requisition_item->vat_price = ($requisition_item->price * $requisition_item->vat) / 100;
            //     $requisition_item->final_price = $requisition_item->price + $requisition_item->vat_price;
            //     $requisition_item->save();
            // }
            // $totalPrice = 0;
            // $totalQuantity = 0;
            // foreach ($requisition->requisition_items as $rqItem) {
            //     // $totalPrice += $rqItem->quantity * $rqItem->price;
            //     $totalPrice += $rqItem->quantity * $rqItem->final_price;
            //     $totalQuantity += $rqItem->quantity;
            // }
            // $requisition->total_quantity = $totalQuantity;
            // $requisition->total_price = $totalPrice;
            // $requisition->save();
        }
        if ($request->type == 'pending_purchase') {
            $requisition->pending_purchase_at = Carbon::now();
            $requisition->status = 'pending_purchase';
            $requisition->save();

            $ids = $request->id;
            $suppliers = $request->suppliers;
            $quantity = $request->quantity;
            $price = $request->price;
            $vat = $request->vat;
            for ($i = 0; $i < count($ids); $i++) {
                $requisition_item = RequisitionItem::find($ids[$i]);
                $requisition_item->quantity = $quantity[$i];
                $requisition_item->supplier_id = $suppliers[$i];
                $requisition_item->price = $price[$i];
                $requisition_item->vat = $vat[$i] ?? 0;
                $requisition_item->vat_price = ($requisition_item->price * $requisition_item->vat) / 100;
                $requisition_item->final_price = $requisition_item->price + $requisition_item->vat_price;
                $requisition_item->save();
            }
            $totalPrice = 0;
            $totalQuantity = 0;
            foreach ($requisition->requisition_items as $rqItem) {
                // $totalPrice += $rqItem->quantity * $rqItem->price;
                $totalPrice += $rqItem->quantity * $rqItem->final_price;
                $totalQuantity += $rqItem->quantity;
            }
            $requisition->total_quantity = $totalQuantity;
            $requisition->total_price = $totalPrice;
            $requisition->save();
        }
        if ($request->type == 'approved_purchase') {
            $requisition->approved_purchase_at = Carbon::now();
            $requisition->status = 'approved_purchase';
            $requisition->save();

            $ids = $request->id;
            $suppliers = $request->suppliers;
            $quantity = $request->quantity;
            $price = $request->price;
            $vat = $request->vat;
            for ($i = 0; $i < count($ids); $i++) {
                $requisition_item = RequisitionItem::find($ids[$i]);
                $requisition_item->quantity = $quantity[$i];
                $requisition_item->supplier_id = $suppliers[$i];
                $requisition_item->price = $price[$i];
                $requisition_item->vat = $vat[$i] ?? 0;
                $requisition_item->vat_price = ($requisition_item->price * $requisition_item->vat) / 100;
                $requisition_item->final_price = $requisition_item->price + $requisition_item->vat_price;
                $requisition_item->save();
            }
            $totalPrice = 0;
            $totalQuantity = 0;
            foreach ($requisition->requisition_items as $rqItem) {
                // $totalPrice += $rqItem->quantity * $rqItem->price;
                $totalPrice += $rqItem->quantity * $rqItem->final_price;
                $totalQuantity += $rqItem->quantity;
            }
            $requisition->total_quantity = $totalQuantity;
            $requisition->total_price = $totalPrice;
            $requisition->save();

        }
        if ($request->type == 'purchase') {
            $requisition->purchase_at = Carbon::now();
            $requisition->status = 'purchase';
            $requisition->save();
        }
        if ($request->status == 'collected') {
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
            $requisition->collected_at = Carbon::now();
            $requisition->status = 'collected';
            $requisition->save();
            return redirect()->back()->with('success', "Requisition Successfully Collected");
        }
        // if ($request->type == 'stocked') {

        //     $collected_qty = $request->collected_quantities;
        //     $ids = $request->ids;
        //     $collected_quantity = 0;
        //     $collect_wise_price = 0;
        //     for ($i = 0; $i < count($ids); $i++) {
        //         $reqItem = RequisitionItem::find($ids[$i]);
        //         $reqItem->collected_qty = $collected_qty[$reqItem->id];
        //         $reqItem->editedBy_id = Auth::id();
        //         $reqItem->save();
        //         $collected_quantity += $reqItem->collected_qty;
        //         $collect_wise_price += $reqItem->collected_qty *  $reqItem->final_price;
        //     }
        //     $requisition->collected_qty = $collected_quantity;
        //     $requisition->collect_wise_price = $collect_wise_price;
        //     $requisition->save();


        //     foreach ($requisition->requisition_items as $rqItem) {
        //         // Supplier Payment
        //         $rqItem->supplier()->increment('total_phrases_amount', $rqItem->collected_qty * $rqItem->final_price);

        //         $previous_raw_stock = RawStock::where('raw_id', $rqItem->raw_id)->first();
        //         if (($previous_raw_stock) && ($rqItem->raw_id == $previous_raw_stock->raw_id) && ($rqItem->price == $previous_raw_stock->unit_price)) {
        //             $previous_raw_stock->total_quantity = $previous_raw_stock->total_quantity + $rqItem->collected_qty;
        //             $previous_raw_stock->save();
        //         } else {
        //             $raw_stock = new RawStock;
        //             $raw_stock->requisition_id = $requisition->id;
        //             $raw_stock->requisition_item_id = $rqItem->id;
        //             $raw_stock->total_quantity = $rqItem->collected_qty;
        //             $raw_stock->unit_price = $rqItem->price;
        //             $raw_stock->vat = $rqItem->vat;
        //             $raw_stock->vat_price = $rqItem->vat_price;
        //             $raw_stock->final_price = $rqItem->final_price;
        //             $raw_stock->raw_id = $rqItem->raw_id;
        //             $raw_stock->category_id = $rqItem->category_id;
        //             $raw_stock->dhpl_cat_id = $rqItem->dhpl_cat_id;
        //             $raw_stock->product_id = $rqItem->product_id;
        //             $raw_stock->product_name = $rqItem->product_name;
        //             $raw_stock->supplier_id = $rqItem->supplier_id;
        //             $raw_stock->unit = $rqItem->raw_materials->unit;
        //             $raw_stock->unit_value = $rqItem->raw_materials->unit_value;
        //             $raw_stock->type = $rqItem->raw_type;
        //             $raw_stock->addedBy_id = Auth::id();
        //             $raw_stock->save();
        //         }
        //         $requisition->stocked_at = Carbon::now();
        //         $requisition->status = 'stocked';
        //         $requisition->save();
        //     }
        // }

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
    function stockedMaterials(Request $request)
    {
        menuSubmenu('stockedMaterials', 'all');
        $type = $request->type;
        if ($request->type == 'raw') {
            menuSubmenu('stockedMaterials', 'rawStockedMaterials');
            $stockedMaterials = RawStock::groupBy('category_id')->where('type', 'raw')->paginate(30);
            $materials = Raw::where('type', 'raw')->get();
        } elseif ($request->type == 'pack') {
            $stockedMaterials = RawStock::groupBy('category_id')->where('type', 'pack')->paginate(30);
            $materials = Raw::where('type', 'pack')->get();
        } elseif ($request->type == 'stationery') {
            menuSubmenu('stockedMaterials', 'stationeryStockedMaterials');
            $materials = Raw::where('type', 'stationery')->get();
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->with('requisition', 'raw')->where('type', 'stationery')->paginate(30);
        } else {
            $stockedMaterials = RawStock::groupBy('category_id')->paginate(30);
        }
        $suppliers = Supplier::where('active', true)->get();
        return view('admin.stockedMaterials', compact('stockedMaterials', 'type', 'suppliers', 'materials'));
    }
    public function stockedMaterialsModifyHistory(RawStock $stock, Request $request)
    {
        if ($request->addition || $request->wastage) {

            $rawStockModifyHistory = new RawStockModifyHistory;
            $rawStockModifyHistory->stock_id = $stock->id;
            $rawStockModifyHistory->raw_id = $stock->raw_id;
            $rawStockModifyHistory->category_id = $stock->category_id;
            $rawStockModifyHistory->previous_stock = $stock->total_quantity;
            $rawStockModifyHistory->addition = $request->addition ?? 0.00;
            $rawStockModifyHistory->wastage = $request->wastage ?? 0.00;
            $newStock = ($rawStockModifyHistory->previous_stock + $rawStockModifyHistory->addition) - $rawStockModifyHistory->wastage;
            $rawStockModifyHistory->new_stock = $newStock;
            $rawStockModifyHistory->remark = $request->Remark;
            $rawStockModifyHistory->addeBy_id = Auth::id();
            $rawStockModifyHistory->save();
            $stock->total_quantity = $rawStockModifyHistory->new_stock;
            $stock->save();
            return response()->json([
                'success' => true,
                'raw_id' => $stock->id,
                'final_quantity' => $stock->total_quantity,
                'final_price' => $stock->total_quantity * $stock->final_price,
                'view' => view('admin.ajax.appendRawModifyHistory', compact('rawStockModifyHistory'))->render(),
                'message' => 'Successfully Added'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Addition or Wastage is Empty. Must input addition or wastage Value'
            ]);
        }
    }
    public function storeCustomMaterials(Request $request)
    {
        $request->validate([
            'material' => 'required',
            'total_quantity' => 'required',
            'unit_price' => 'required',
        ]);
        $raw = Raw::find($request->material);
        $type = $request->type;
        $raw_stock = new RawStock;
        $raw_stock->raw_id = $raw->id;
        $raw_stock->dhpl_cat_id = $raw->dhpl_cat_id;
        $raw_stock->product_id = $raw->product_id;
        $raw_stock->product_name = $raw->product_name;
        $raw_stock->total_quantity = $request->total_quantity;
        $raw_stock->unit_price = $request->unit_price;
        $raw_stock->category_id = $raw->category_id;
        if ($request->supplier_id) {
            $raw_stock->supplier_id = $request->supplier;
        } else {
            $raw_stock->supplier_id = 3;
        }

        $raw_stock->unit = $raw->unit;
        $raw_stock->unit_value = $raw->unit_value;
        $raw_stock->type = $raw->type;
        $raw_stock->vat = $request->vat ? $request->vat : 0.00;
        $vatPrice = ($raw_stock->unit_price * $raw_stock->vat) / 100;
        $final_price = $raw_stock->unit_price + $vatPrice;

        $raw_stock->vat_price = $vatPrice;
        $raw_stock->final_price = $final_price;
        $raw_stock->by_requisition = false;
        $raw_stock->save();
        $supplier = Supplier::find($raw_stock->supplier_id);
        $supplier->total_phrases_amount =  $supplier->total_phrases_amount + $raw_stock->final_price;
        $supplier->save();
        return redirect()->back()->with('success', 'Stocked Materials Successfully Added');
    }
    public function newRequisition(Request $request)
    {
        menuSubmenu('requisition', 'addRawRequisition');
        $requisition = Requisition::where('status', 'temp')->where('user_id', Auth::id())->where('type', 'raw')->first();
        if (!$requisition) {
            $requisition = new Requisition;
            $requisition->user_id = Auth::id();
            $requisition->addedBy_id = Auth::id();
            $requisition->status = 'temp';
            $requisition->type = 'raw';
            $requisition->save();
        }

        $rawMaterials = Raw::where('type', 'raw')->orderBy('name')->get();
        $packMaterials = Raw::where('type', 'pack')->orderBy('name')->get();
        $suppliers = Supplier::where('active', true)->get();
        return view('admin.requisition.addNewRawRequisition', compact('packMaterials', 'rawMaterials', 'suppliers', 'requisition'));
    }
    public function stationaryRequisition(Request $request)
    {
        menuSubmenu('requisition', 'addNewStationaryRequisition');
        $requisition = Requisition::where('status', 'temp')->where('user_id', Auth::id())->where('type', 'stationery')->first();
        if (!$requisition) {
            $requisition = new Requisition;
            $requisition->user_id = Auth::id();
            $requisition->addedBy_id = Auth::id();
            $requisition->status = 'temp';
            $requisition->type = 'stationery';
            $requisition->save();
        }

        $rawMaterials = Raw::where('type', 'raw')->orderBy('name')->get();
        $packMaterials = Raw::where('type', 'pack')->orderBy('name')->get();
        $suppliers = Supplier::where('active', true)->get();
        return view('admin.requisition.addNewStationaryRequisition', compact('packMaterials', 'rawMaterials', 'suppliers', 'requisition'));
    }
    public function packagingRequisition(Request $request)
    {
        menuSubmenu('requisition', 'newRequisition');
        $requisition = Requisition::where('status', 'temp')->where('user_id', Auth::id())->where('type', 'pack')->first();
        if (!$requisition) {
            $requisition = new Requisition;
            $requisition->user_id = Auth::id();
            $requisition->addedBy_id = Auth::id();
            $requisition->status = 'temp';
            $requisition->type = 'pack';
            $requisition->save();
        }

        $tempPacks = PackReqTemp::where('user_id', Auth::id())->get();
        // dd($tempPacks);
        $packCategories = Category::where('type', 'pack')->orderBy('name')->get();

        return view('admin.requisition.addNewPackRequisition', compact('packCategories', 'requisition', 'tempPacks'));
    }


}
