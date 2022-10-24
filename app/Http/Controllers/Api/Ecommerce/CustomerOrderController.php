<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function myOrders()
    {
        $data = auth()->user()->getMyOrders(2);
        return response()->json($data, 200);

    }
    public function myOrderDetails(EcommerceOrder $order)
    {
        if (auth()->user()->id != $order->user_id) {
            return response()->json('No order found', 209);
        }
        $data = $order->load('items','payment');
        return response()->json($data, 200);
    }
    public function makePayment(EcommerceOrder $order, Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'bank_name' => 'required|max:255',
            'account_number' => 'required',
            'cheque_number' => 'required',
            'amount' => 'required',
            'note' => 'max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 209);
        }
        $payment = $order->fetchOrCreatePayment();
        $payment->bank_name = $request->bank_name;
        $payment->account_number = $request->account_number;
        $payment->cheque_number = $request->cheque_number;
        $payment->paid_amount = $request->amount;
        $payment->note = $request->note;
        $payment->payment_status = 'on_review';

        $payment->save();

        return response()->json($payment, 200);
    }
}
