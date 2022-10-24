<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DailyProduction;
use App\Models\Product;
use App\Models\Raw;
use App\Models\RawStock;
use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\Sample;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use DB;

class AccountsController extends Controller
{
    public $dhpl;
    public function __construct()
    {
        $this->dhpl = DB::connection('dhpl');
    }
    public function dashboard(Request $request)
    {
        menuSubmenu('dashboard', 'dashboard');
        $account = Auth::user()->myroles();
        return view('accounts.dashboard.AccountsDashboard', compact('account'));
    }
    public function image(Request $request)
    {
        return $request->file('file');
    }

    public function getChartData()
    {
        $pendingRequisition = Requisition::where('status', 'pending')->count();
        $approvedRequisition = Requisition::where('status', 'approved')->count();
        $collectedRequisition = Requisition::where('status', 'collected')->count();
        $stockedRequisition = Requisition::where('status', 'stocked')->count();

        $requisitionChartData = [
            'labels' => [
                'Pending',
                'Approved',
                'Collected',
                'Stocked',
            ],
            'datasets' => [
                [
                    'data' => [$pendingRequisition, $approvedRequisition, $collectedRequisition, $stockedRequisition],
                    'backgroundColor' => ['#d2d6de', '#00c0ef', '#3c8dbc', '#00FF00'],
                ]
            ],
        ];

        $thisMonthProduct = Product::whereMonth('created_at', now()->month)->where('status', 'in_stocked')->count();
        $thisMonthQuantity = Product::whereMonth('created_at', now()->month)->sum('multiply_qty');
        $prev1MonthProduct = Product::whereMonth('created_at', now()->subMonths(1)->month)->where('status', 'in_stocked')->count();
        $prev1MonthQuantity = Product::whereMonth('created_at', now()->subMonths(1)->month)->sum('multiply_qty');
        $prev2MonthProduct = Product::whereMonth('created_at', now()->subMonths(2)->month)->where('status', 'in_stocked')->count();
        $prev2MonthQuantity = Product::whereMonth('created_at', now()->subMonths(2)->month)->sum('multiply_qty');
        $prev3MonthProduct = Product::whereMonth('created_at', now()->subMonths(3)->month)->where('status', 'in_stocked')->count();
        $prev3MonthQuantity = Product::whereMonth('created_at', now()->subMonths(3)->month)->sum('multiply_qty');
        $prev4MonthProduct = Product::whereMonth('created_at', now()->subMonths(4)->month)->where('status', 'in_stocked')->count();
        $prev4MonthQuantity = Product::whereMonth('created_at', now()->subMonths(4)->month)->sum('multiply_qty');
        $prev5MonthProduct = Product::whereMonth('created_at', now()->subMonths(5)->month)->where('status', 'in_stocked')->count();
        $prev5MonthQuantity = Product::whereMonth('created_at', now()->subMonths(5)->month)->sum('multiply_qty');

        $readyProductChartData = [
            'labels' => [now()->subMonths(5)->format('M'), now()->subMonths(4)->format('M'), now()->subMonths(3)->format('M'), now()->subMonths(2)->format('M'), now()->subMonths(1)->format('M'), now()->format('M')],
            'datasets' => [
                [
                    'label' => 'Monthly Ready Product Qty',
                    'backgroundColor' => 'rgba(210, 214, 222, 1)',
                    'borderColor' => 'rgba(210, 214, 222, 1)',
                    'pointRadius' => false,
                    'pointColor' => 'rgba(210, 214, 222, 1)',
                    'pointStrokeColor' => '#c1c7d1',
                    'pointHighlightFill' => '#fff',
                    'pointHighlightStroke' => 'rgba(220,220,220,1)',
                    'data' => [$prev5MonthQuantity, $prev4MonthQuantity, $prev3MonthQuantity, $prev2MonthQuantity, $prev1MonthQuantity, $thisMonthQuantity]
                ],
                [
                    'label' => 'Monthly Ready Product',
                    'backgroundColor' => 'rgba(60,141,188,0.9)',
                    'borderColor' => 'rgba(60,141,188,0.8)',
                    'pointRadius' => false,
                    'pointColor' => '#3b8bba',
                    'pointStrokeColor' => 'rgba(60,141,188,1)',
                    'pointHighlightFill' => '#fff',
                    'pointHighlightStroke' => 'rgba(60,141,188,1)',
                    'data' => [$prev5MonthProduct, $prev4MonthProduct, $prev3MonthProduct, $prev2MonthProduct, $prev1MonthProduct, $thisMonthProduct]
                ],
            ],
        ];

        $data = [
            'requisitionChartData' => $requisitionChartData,
            'readyProductChartData' => $readyProductChartData,
        ];

        return response()->json($data, 200);
    }

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
        }elseif ($type == 'pending_purchase') {
            $requisitions = Requisition::where('status', 'pending_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'approved_purchase') {
            $requisitions = Requisition::where('status', 'approved_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'purchase') {
            $requisitions = Requisition::where('status', 'purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        }  elseif ($type == 'collected') {
            $requisitions = Requisition::where('status', 'collected')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'stocked') {
            $requisitions = Requisition::where('status', 'stocked')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } else {
            return back();
        }

        return view('accounts.requisition.requisitionAll', compact('requisitions', 'type'));
    }

    public function requisitionProcess(Request $request)
    {

        $requisition = Requisition::find($request->requisition);
        $suppliers = Supplier::where('active', true)->orderBy('name')->get();
        return view('accounts.requisition.requisition', compact('requisition', 'suppliers'));
    }

    public function requisitionProcessUpdate(Request $request)
    {
        $request->validate([
            'suppliers.*' => 'required',
            'quantity.*' => 'required',
            'price.*' => 'required',
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
        if ($request->type == 'collected') {
            $requisition->collected_at = Carbon::now();
            $requisition->status = 'collected';
            $requisition->save();
        }
        if ($request->type == 'stocked') {


            foreach ($requisition->requisition_items as $rqItem) {
                // Supplier Payment
                $rqItem->supplier()->increment('total_phrases_amount', $rqItem->quantity * $rqItem->final_price);

                $previous_raw_stock = RawStock::where('raw_id', $rqItem->raw_id)->first();
                if (($previous_raw_stock) && ($rqItem->raw_id == $previous_raw_stock->raw_id) && ($rqItem->price == $previous_raw_stock->unit_price)) {
                    $previous_raw_stock->total_quantity = $previous_raw_stock->total_quantity + $rqItem->quantity;
                    $previous_raw_stock->save();
                } else {
                    $raw_stock = new RawStock;
                    $raw_stock->requisition_id = $requisition->id;
                    $raw_stock->requisition_item_id = $rqItem->id;
                    $raw_stock->total_quantity = $rqItem->quantity;
                    $raw_stock->unit_price = $rqItem->price;
                    $raw_stock->vat = $rqItem->vat;
                    $raw_stock->vat_price = $rqItem->vat_price;
                    $raw_stock->final_price = $rqItem->final_price;
                    $raw_stock->raw_id = $rqItem->raw_id;
                    $raw_stock->category_id = $rqItem->category_id;
                    $raw_stock->supplier_id = $rqItem->supplier_id;
                    $raw_stock->unit = $rqItem->raw_materials->unit;
                    $raw_stock->unit_value = $rqItem->raw_materials->unit_value;
                    $raw_stock->type = $rqItem->raw_type;
                    $raw_stock->addedBy_id = Auth::id();
                    $raw_stock->save();
                }
                $requisition->stocked_at = Carbon::now();
                $requisition->status = 'stocked';
                $requisition->save();
            }
        }

        return redirect()->back()->with('success', "Requisition Successfully $request->type");
    }
    public function stockedMaterials(Request $request)
    {
        menuSubmenu('stockedMaterials', 'all');
        $type = $request->type;
        if ($request->type == 'raw') {
            menuSubmenu('stockedMaterials', 'rawStockedMaterials');
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->with('category', 'requisition', 'raw')->where('type', 'raw')->paginate(30);
        } elseif ($request->type == 'pack') {
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->with('category', 'requisition', 'raw')->where('type', 'pack')->paginate(30);
        } elseif ($request->type == 'stationery') {
            menuSubmenu('stockedMaterials', 'stationeryStockedMaterials');
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->with('requisition', 'raw')->where('type', 'stationery')->paginate(30);
        } else {

            $stockedMaterials = RawStock::orderBy('id', 'DESC')->with('category', 'requisition', 'raw')->paginate(30);
        }
        return view('accounts.stockedMaterials', compact('stockedMaterials', 'type'));
    }

    public function allSamples()
    {
        menuSubmenu('samples', 'allSamples');
        $samples = Sample::latest()->paginate(50);
        return view('accounts.samples.allSamples', compact('samples'));
    }
    public function viewSample(Request $request)
    {
        $sample = Sample::with('sample_items')->where('id', $request->sample)->where('active', true)->first();
        return view('accounts.samples.viewSamples', compact('sample'));
    }

    ///Suplliers
    public function allSupliers(Request $request)
    {
        menuSubmenu('suppliers', 'allSuppliers');
        if ($request->supplier) {
            $suppliers = Supplier::where('active', true)->where('id', $request->supplier)->paginate(50);
        } else {
            $suppliers = Supplier::where('active', true)->orderBy('id', 'DESC')->paginate(50);
        }

        return view('accounts.suppliers.allSuppliers', compact('suppliers'));
    }
    public function supplierOrders(Supplier $supplier)
    {

        $orders = Requisition::whereHas('requisition_items', function ($q) use ($supplier) {
            $q->where('supplier_id', $supplier->id);
        })
            ->where("status", 'stocked')
            ->orderBy('id', 'DESC')
            ->paginate(50);

        return view('accounts.suppliers.orderHistory', compact('supplier', 'orders'));
    }

    public function supplierPaymentHistory(Supplier $supplier)
    {

        $paymentHistories = SupplierPayment::where('supplier_id', $supplier->id)->orderBy('id', 'DESC')->paginate(50);
        $last_payment = SupplierPayment::where('supplier_id', $supplier->id)->latest()->first();
        return view('accounts.suppliers.paymentHistory', compact('supplier', 'paymentHistories','last_payment'));
    }

    public function supplierOrderDetails(Request $request)
    {
        $supplier = Supplier::find($request->supplier);
        $order = Requisition::find($request->order);
        if (!$order) {
            return redirect()->back()->with('warning', 'Something Worng');
        }

        return view('accounts.suppliers.orderDetails', compact('supplier', 'order'));
    }
    public function downloadSupplierOrderDetails(Request $request)
    {
        $supplier = Supplier::find($request->supplier);
        $order = Requisition::find($request->order);

        if (!$order) {
            return redirect()->back()->with('warning', 'Something Worng');
        }
        $pdf = PDF::loadView('accounts.suppliers.invoice', compact('supplier', 'order'));

        return $pdf->download($supplier->name . $order->id . '.pdf');
    }
    public function addMoreSupplier(Request $request)
    {
        $item = RequisitionItem::find($request->item);
        $requisition = Requisition::find($request->requisition);
        $suppliers = Supplier::where('active', true)->get();
        return view('accounts.ajax.addMoreSupplier', compact('suppliers', 'item', 'requisition'))->render();
    }
    public function storeMoreSupplier(Request $request)
    {
        $requisition = Requisition::find($request->requisition);
        $item = RequisitionItem::find($request->item);
        $putRqItem = new RequisitionItem;
        $putRqItem->user_id = Auth::id();
        $putRqItem->requisition_id = $item->requisition_id;
        $putRqItem->quantity = $request->quantity;
        $putRqItem->price = $request->price;
        $putRqItem->raw_id = $item->raw_id;
        $putRqItem->category_id = $item->category_id;
        $putRqItem->pack_cat_id = $item->pack_cat_id;
        $putRqItem->product_id = $item->product_id;
        $putRqItem->product_name = $item->product_name;
        $putRqItem->unit = $item->unit;
        $putRqItem->unit_value = $item->unit_value;
        $putRqItem->dhpl_cat_id = $item->dhpl_cat_id;
        $putRqItem->vat = $request->vat;
        $putRqItem->vat_price = ($putRqItem->price * $putRqItem->vat) / 100;
        $putRqItem->final_price = $putRqItem->price + $putRqItem->vat_price;;
        $putRqItem->raw_type = $item->raw_type;
        $putRqItem->supplier_id = $request->supplier;
        $putRqItem->addedBy_id = Auth::id();
        $putRqItem->save();
        return true;
    }
    public function materials(Request $request)
    {
        $type = $request->type;
        if ($type == 'raw') {
            menuSubmenu('Materials', 'RowMaterials');
            $rawMaterials = Raw::with('category')->where('type', $type)->orderBy('id', 'DESC')->paginate(50);
            $categories = Category::where('type', 'raw')->where('active', true)->get();
            return view('accounts.materials.rawMaterials', compact('rawMaterials', 'categories'));
        }
        if ($type == 'pack') {
            menuSubmenu('Materials', 'PackagingMaterials');
            $packaging = Raw::where('type', $type)->orderBy('id', 'DESC')->paginate(50);
            $categories = Category::where('type', 'pack')->where('active', true)->get();
            return view('accounts.materials.packaging', compact('packaging', 'categories'));
        }
        if ($type == 'stationery') {
            menuSubmenu('Materials', 'stationeryMaterials');
            $stationeries = Raw::where('type', $type)->with('category')->orderBy('id', 'DESC')->paginate(50);
            return view('accounts.materials.stationeries', compact('stationeries', 'type'));
        }
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
        return view('accounts.dailyProduction.index', compact('products', 'dailyProduction', 'type'));
    }

    //Category Subcategory

    public function category(Request $request)
    {
        $categories = Category::latest()->paginate(20);
        menuSubmenu('category', 'allCategory');
        return view('accounts.category.index', compact('categories'));
    }
    public function subcategories()
    {
        menuSubmenu('category', 'allSbCategories');
        $sub_categories = SubCategory::orderBy('name')->latest()->paginate(20);
        $categories = Category::where('active', true)->latest()->get();
        return view('accounts.category.subCategory.index', compact('sub_categories', 'categories'));
    }
}
