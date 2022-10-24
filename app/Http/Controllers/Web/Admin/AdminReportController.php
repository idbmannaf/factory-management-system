<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommercePaymentCollection;
use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\RequisitionItem;
use App\Models\Role\Agent;
use App\Models\SaleCommission;
use App\Models\ShipmentReturn;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type, Request $request)
    {
        menuSubmenu('report', $type);

        if (isset($request->from) or isset($request->to)) {
            $validator = Validator::make($request->all(), [
                'from' => 'date|before:to',
                'to' => 'date|before:tomorrow',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $suppliers = Supplier::where('active', true)->get();
        if ($type == 'payment') {
            $start = Carbon::parse($request->from)->format('Y-m-d') . ' 00:00:00';
            //2022-03-08 19:53:07
            $end = Carbon::parse($request->to)->format('Y-m-d')  . ' 23:59:59';

            $payments = SupplierPayment::where(function ($query) use ($request, $start, $end, $suppliers) {
                if ($request->time == 'today') {
                    $query->whereDate('created_at', Carbon::now());
                } elseif ($request->time == 'date_range') {
                    $query->whereBetween('created_at', [$start, $end]);
                }
                if ($request->supplier) {
                    $query->where('supplier_id', $request->supplier);
                } else {
                    $query->whereIn('supplier_id', $suppliers->pluck('id'));
                }
            })->orderBy('supplier_id')->get();

            // $orders = RequisitionItem::whereHas('rquisition',function($q){
            //     $q->where('status','stocked');
            // })
            // ->with('rquisition')
            // ->get();
            // dd($orders);

            return view('admin.report.supplierPaymentReport', [
                'type' => $type,
                'suppliers' => $suppliers,
                'payments' => $payments,
                'input' => $request->all(),
            ]);
        } elseif ($type == 'supplierdue') {
            $start = Carbon::parse($request->from)->format('Y-m-d') . ' 00:00:00';
            //2022-03-08 19:53:07
            $end = Carbon::parse($request->to)->format('Y-m-d')  . ' 23:59:59';

            $supplierDues = Supplier::where('active', true)
                ->where(function ($query) use ($request, $start, $end, $suppliers) {
                    // $query->whereDate('created_at', Carbon::now());
                    if ($request->time == 'today') {
                        $query->whereDate('created_at', Carbon::now());
                    } elseif ($request->time == 'date_range') {
                        $query->whereBetween('created_at', [$start, $end]);
                    }
                    if ($request->supplier) {
                        $query->where('id', $request->supplier);
                    } else {
                        $query->whereIn('id', $suppliers->pluck('id'));
                    }
                })
                // ->where('active',true)
                ->get();

            return view('admin.report.supplierDueReport', [
                'type' => $type,
                'suppliers' => $suppliers,
                'supplierDues' => $supplierDues,
                'input' => $request->all(),
            ]);
        } elseif ($type == 'supplierorder') {
            $start = Carbon::parse($request->from)->format('Y-m-d') . ' 00:00:00';
            $end = Carbon::parse($request->to)->format('Y-m-d')  . ' 23:59:59';

            $supplierOrders = RequisitionItem::where(function ($query) use ($request, $start, $end, $suppliers) {
                    if ($request->time == 'today') {
                        $query->whereDate('created_at', Carbon::now());
                    } elseif ($request->time == 'date_range') {
                        $query->whereBetween('created_at', [$start, $end]);
                    }
                    if ($request->supplier) {
                        $query->where('supplier_id', $request->supplier);
                    } else {
                        $query->whereIn('supplier_id', $suppliers->pluck('id'));
                    }
                })
                ->orderBy('supplier_id')
                ->groupBy('supplier_id')
                ->get();

            return view('admin.report.supplierOrderReport', [
                'type' => $type,
                'suppliers' => $suppliers,
                'supplierOrders' => $supplierOrders,
                'input' => $request->all(),
            ]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function commissionList(SaleCommission $com)
    {
        menuSubmenu('commissions', 'all');
        $commissions = $com->latest()->paginate(50);
        return view('admin.ecommerce.commission.index', [
            'commissions' => $commissions,
        ]);
    }
}
