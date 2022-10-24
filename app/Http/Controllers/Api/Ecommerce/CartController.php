<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceCart;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommerceOrderItem;
use App\Models\Ecommerce\EcommerceOrderPayments;
use App\Models\Ecommerce\EcommerceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function getCarts()
    {
        $carts = auth()->user()->ecommerceCarts;
        $tpr = 0;
        if ($carts->count() > 0) {
            foreach ($carts as $cart) {
                $tpr = $tpr + ($cart->quantity*$cart->product->sale_price);
            }
        }
        $data['carts'] = $carts;
        $data['total_price'] = floatval($tpr);
        return response()->json($data, 200);
    }
    public function getProductCart(EcommerceProduct $product)
    {
        $data = $product->findCart();
        return response()->json($data, 200);
    }
    public function addToCart(EcommerceProduct $product, Request $request, EcommerceCart $cart)
    {
        $c = $cart->getOrAddCart($product);
        if (isset($request->quantity) && $request->quantity > $product->min_order_quantity) {
            $c->quantity = $request->quantity;
            $c->save();
        }else{
            $c->quantity = $product->min_order_quantity;
            $c->save();
        }
        $data = $c;
        return response()->json($data, 200);
    }

    public function removeCart(EcommerceProduct $product, Request $request, EcommerceCart $cart)
    {
        $cartData = $cart->getOrAddCart($product);
        $cartData->delete();
        $data = auth()->user()->ecommerceCarts;
        return response()->json($data, 200);
    }

    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'mobile' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
          return response()->json($validator->errors(), 209);
        }
        $order = auth()->user()->fetchOrCreateTempOrder();
        $order->mobile = $request->mobile;
        $order->address = $request->address;
        $order->save();

        return response()->json($order, 200);
    }

    public function paymentMethod(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 209);
        }
        $order = auth()->user()->fetchOrCreateTempOrder();
        $payment = $order->fetchOrCreatePayment();
        $payment->payment_type = $request->payment_method;
        $payment->save();

        $carts = auth()->user()->ecommerceCarts;
        $price = 0.00;
        foreach ($carts as $cart) {
            $p = $cart->product->priceByQuantity($cart->quantity);
            $itemPrice = $p*$cart->quantity;

            $orderItem = new EcommerceOrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cart->product_id;
            $orderItem->product_name = $cart->product->name;
            $orderItem->unit_price = $p;
            $orderItem->total_quantity = $cart->quantity;
            $orderItem->total_price = $itemPrice;
            $orderItem->user_id = auth()->user()->id;
            $orderItem->save();

            $price = $price+$itemPrice;

            $cart->delete();
        }
        $order->total_price = $price;
        $order->order_status = 'pending';
        $order->pending_at = now();
        $order->save();
        $data = $order->load('items', 'payment');
        return response()->json($data, 200);
    }

    public function getOrderDetails(EcommerceOrder $order)
    {
        $data = $order->load('items','payment');
        return response()->json($data, 200);
    }

    public function payment(Request $request)
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

        $order = auth()->user()->fetchOrCreateTempOrder();

        $payment = $order->fetchOrCreatePayment();
        $payment->bank_name = $request->bank_name;
        $payment->account_number = $request->account_number;
        $payment->cheque_number = $request->cheque_number;
        $payment->paid_amount = $request->amount;
        $payment->note = $request->note;

        $payment->save();

        return response()->json($payment, 200);
    }
}
