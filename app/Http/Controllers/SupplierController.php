<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;

class SupplierController extends Controller
{
    public function allSuppliers()
    {
        menuSubmenu('suppliers', 'allSuppliers');
        $suppliers = Supplier::orderBy('id', 'DESC')->paginate(50);
        return view('admin.suppliers.allSuppliers', compact('suppliers'));
    }

    public function addSupplier(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile' => 'required',
            'active' => 'nullable',
        ]);
        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->mobile = $request->mobile;
        $supplier->active = $request->active ? 1 : 0;
        $supplier->addedBy_id = Auth::id();
        $supplier->save();
        return redirect()->back()->with('success', 'Supplier Successfully Added');
    }

    public function updateSupplier(Request $request, Supplier $supplier)
    {

        $supplier->name = $request->name;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->mobile = $request->mobile;
        $supplier->active = $request->active ? 1 : 0;
        $supplier->editedBy_id = Auth::id();
        $supplier->save();
        return redirect()->back()->with('success', 'Supplier Successfully Updated');
    }

    public function deleteSupplier(Supplier $supplier)
    {
        if ($supplier->hasRawStocks() ||$supplier->hasRequisitonItems() ||$supplier->hasPayment()) {
            return redirect()->back()->with('warning', 'You are not able to delete this supplier.');
        }
        $supplier->delete();
        return redirect()->back()->with('success', 'Supplier Successfully Deleted');
    }
    public function supplierOrders(Supplier $supplier)
    {
        // $orders = RequisitionItem::where('supplier_id', $supplier->id)->orderBy('id', 'DESC')->paginate(50);
        $orders = Requisition::whereHas('requisition_items',function($q) use ($supplier){
            $q->where('supplier_id',$supplier->id);
        })
        ->where("status",'stocked')
        ->orderBy('id','DESC')
        ->paginate(50);

        return view('admin.suppliers.orderHistory', compact('supplier', 'orders'));
    }

    public function supplierOrderDetails(Request $request)
    {
        $supplier = Supplier::find($request->supplier) ;
        $order = Requisition::find($request->order);
        if (!$order) {
            return redirect()->back()->with('warning','Something Worng');
        }

        return view('admin.suppliers.orderDetails',compact('supplier','order'));

    }

    public function supplierPaymentHistory(Supplier $supplier)
    {
        $paymentHistories = SupplierPayment::where('supplier_id', $supplier->id)->orderBy('id', 'DESC')->paginate(50);
        $last_payment = SupplierPayment::where('supplier_id', $supplier->id)->latest()->first();
        return view('admin.suppliers.paymentHistory', compact('supplier', 'paymentHistories','last_payment'));
    }

    public function payNow(Supplier $supplier, Request $request)
    {
        $request->validate([
            'paid_amount' => 'required|min:1',
            'payment_method' => 'required',
        ]);
        $due_amount = $supplier->total_phrases_amount - $supplier->total_paid_amount;
        if ($request->paid_amount > $due_amount) {
            return redirect()->back()->with('error', "You are trying to pay {$request->paid_amount} Taka. You are not able to pay more then {$due_amount} Taka");
        }if ($request->paid_amount <=1) {
            return redirect()->back()->with('error', "Amount Must be minimum 1 Taka");
        }

        $supplier_payment = new SupplierPayment;
        $supplier_payment->supplier_id = $supplier->id;
        $supplier_payment->payment_by = Auth::id();
        $supplier_payment->previous_balance =  $due_amount;
        $supplier_payment->moved_balance = $request->paid_amount;
        $supplier_payment->new_balance = $supplier_payment->previous_balance - $supplier_payment->moved_balance ;
        $supplier_payment->payment_method = $request->payment_method;
        $supplier_payment->account = $request->account_number;
        $supplier_payment->note = $request->note;
        $supplier_payment->addedBy_id = Auth::id();
        $supplier_payment->save();
        $supplier->increment('total_paid_amount', $supplier_payment->moved_balance);
        return redirect()->back()->with('success', 'Successfully Paid');
    }
    public function updatePayment(Supplier $supplier,Request $request)
    {
        $request->validate([
            'paid_amount' => 'required|min:1',
            'payment_method' => 'required',
        ]);
        $due_amount = $supplier->total_phrases_amount - $supplier->total_paid_amount;
        if ($request->paid_amount > $due_amount) {
            return redirect()->back()->with('error', "You are trying to pay {$request->paid_amount} Taka. You are not able to pay more then {$due_amount} Taka");
        }if ($request->paid_amount <=1) {
            return redirect()->back()->with('error', "Amount Must be minimum 1 Taka");
        }

        $supplier_payment = SupplierPayment::find($request->payment);
        $supplier_payment->payment_by = Auth::id();
        $supplier_payment->previous_balance =  $due_amount;
        $supplier->decrement('total_paid_amount', $supplier_payment->moved_balance);
        $supplier_payment->moved_balance = $request->paid_amount;
        $supplier_payment->new_balance = $supplier_payment->previous_balance - $supplier_payment->moved_balance ;
        $supplier_payment->payment_method = $request->payment_method;
        $supplier_payment->account = $request->account_number;
        $supplier_payment->note = $request->note;
        $supplier_payment->editedBy_id = Auth::id();
        $supplier_payment->save();
        $supplier->increment('total_paid_amount', $supplier_payment->moved_balance);
        return redirect()->back()->with('success', 'Payment Successfully Updated');

    }
    public function deletePayment(Supplier $supplier,Request $request)
    {
        $supplier_payment = SupplierPayment::find($request->payment);
        $supplier->decrement('total_paid_amount', $supplier_payment->moved_balance);
        $supplier_payment->delete();
        return redirect()->back()->with('success', 'Payment Successfully Deleted');
    }
    public function orderSearch(Request $request, Supplier $supplier)
    {

        // $orders = $supplier->whereHas('requisiton_items', function ($q) use ($request) {
        //     $q->where('id', "like", '%' . $request->q . "%");
        //     $q->orWhereHas('raw_materials', function ($q) use ($request) {
        //         $q->where('name', "like", '%' . $request->q . "%");
        //         $q->orWhere('unit', "like", '%' . $request->q . "%");
        //         $q->orWhere('unit_value', "like", '%' . $request->q . "%");
        //     });

        // })->paginate(50);
        // dd($orders);
        // return view('admin.suppliers.ordersAjax', compact('orders'));
        $orders = RequisitionItem::where(function ($q) use ($supplier) {
            $q->where('supplier_id', $supplier->id);
        })
            ->where('id', "like", '%' . $request->q . "%")
            ->whereHas('rquisition', function ($qq) use ($request) {
                $qq->where('status', 'stocked');
            })
            ->orWhereHas('raw_materials', function ($q) use ($request) {
                $q->where('name', "like", '%' . $request->q . "%");
                $q->orWhere('unit', "like", '%' . $request->q . "%");
                $q->orWhere('unit_value', "like", '%' . $request->q . "%");
            })
            ->paginate(50);
        return view('admin.suppliers.ordersAjax', compact('orders'));
    }
    // for Accountant Start

    // for Accountant END

}
