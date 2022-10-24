<?php

namespace App\Http\Controllers\Web\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\ProductReplacement;
use App\Models\ProductReplacementItem;
use App\Models\ShipmentReturn;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(EcommerceOrder $order, Request $request)
    {
        menuSubmenu('orders', 'orders');
        if ($request->type == 'all') {
            menuSubmenu('orders', 'allOrders');
            $type = "all";
            $orders = $order->latest()->where('order_status', '<>', 'temp')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'pending') {
            menuSubmenu('orders', 'pendingOrders');
            $type = "pending";
            $orders = $order->latest()->where('order_status', 'pending')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'confirmed') {
            menuSubmenu('orders', 'confirmedOrders');
            $type = "confirmed";
            $orders = $order->latest()->where('order_status', 'confirmed')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'processing') {
            menuSubmenu('orders', 'processingOrders');
            $type = "processing";
            $orders = $order->latest()->where('order_status', 'processing')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'shipped') {
            menuSubmenu('orders', 'shippedOrders');
            $type = "shipped";
            $orders = $order->latest()->where('order_status', 'shipped')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'collected') {
            menuSubmenu('orders', 'collectedOrders');
            $type = "collected";
            $orders = $order->latest()->where('order_status', 'collected')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'delivered') {
            menuSubmenu('orders', 'deliveredOrders');
            $type = "delivered";
            $orders = $order->latest()->where('order_status', 'delivered')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'cancelled') {
            menuSubmenu('orders', 'cancelledOrders');
            $type = "cancelled";
            $orders = $order->latest()->where('order_status', 'cancelled')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'returned') {
            menuSubmenu('orders', 'returnedOrders');
            $type = "pending";
            $orders = $order->latest()->where('order_status', 'returned')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } elseif ($request->type == 'undelivered') {
            menuSubmenu('orders', 'undeliveredOrders');
            $type = "undelivered";
            $orders = $order->latest()->where('order_status', 'undelivered')->with('items', 'orderForUser', 'orderByAgent')->paginate(20);
        } else {
            return redirect()->back();
        }
        return view('admin.ecommerce.order.index', [
            'orders' => $orders,
            'type' => $type,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(EcommerceOrder $order)
    {
        return view('admin.ecommerce.order.updateOrder', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function orderOrderStatusUpdate(EcommerceOrder $order, Request $request)
    {

        $this->validate($request, [
            'order_status' => 'required',
        ]);

        $req = $request->all();

        $price = 0;
        $collection = 0;
        if ($order->order_status == 'pending') {
            foreach ($order->items as $item) {
                $qty = $req['order_qty_' . $item->id];
                if ($qty && $qty > 0) {
                    if ($item->product->pice) {
                        if ($item->product->pice > $qty) {
                            $item->bonus = 0;
                        }
                        $bonus = ($item->product->bonus * $qty) / $item->product->pice;
                        $item->bonus = (int)$bonus;
                    } else {
                        $item->bonus = 0;
                    }
                    $item->total_quantity = $qty;
                    $item->total_price = round($qty * $item->unit_price, 2);
                    $shop_commission = $item->source->commissionByProduct($item->product_id);
                    $shop_payment = round($item->total_price - (($item->total_price / 100) * $shop_commission), 2);
                    $item->collection_amount = $shop_payment;
                    $item->save();

                    $price = $price + $item->total_price;
                    $collection = $collection + $item->collection_amount;
                } else {
                    $item->delete();
                }
            }
            $order->total_price = $price;
            $order->total_collection_amount = $collection;
            $order->save();
        }

        $order->order_status = $request->order_status;
        if ($request->order_status == 'pending') {
            $order->pending_at = now();
        }
        if ($request->order_status == 'confirmed') {
            $order->confirmed_at = now();
        }
        if ($request->order_status == 'processing') {
            $order->processing_at = now();
        }
        if ($request->order_status == 'ready_to_ship') {
            $order->ready_to_ship_at = now();
        }
        if ($request->order_status == 'shipped') {
            $order->shipped_at = now();
        }
        if ($request->order_status == 'collected') {
            $order->collected_at = now();
        }
        if ($request->order_status == 'delivered') {
            $order->delivered_at = now();
        }
        if ($request->order_status == 'cancelled') {
            $order->cancelled_at = now();
        }
        if ($request->order_status == 'returned') {
            $order->returned_at = now();
        }
        if ($request->order_status == 'undelivered') {
            $order->undelivered_at = now();
        }
        $order->save();

        return redirect()->back()->with('success', "Order status is changed to {$order->order_status} !");
    }

    public function returnList(ShipmentReturn $return)
    {
        menuSubmenu('returns', 'allReturns');
        $returns = $return->latest()->paginate(50);
        return view('admin.ecommerce.return.index', [
            'returns' => $returns,
        ]);
    }

    public function returnShow(ShipmentReturn $return)
    {
        menuSubmenu('returns', 'allReturns');
        return view('admin.ecommerce.return.edit', [
            'return' => $return,
        ]);
    }

    public function returnStatusUpdate(ShipmentReturn $return, $status)
    {
        if ($status == 'accepted') {
            // dd($return);
            $return->return_status = $status;
            $return->approved_at = now();
            $return->approvedby_id = auth()->user()->id;
            $return->editedby_id = auth()->user()->id;
            $return->save();

            $replacement = new ProductReplacement;
            $replacement->shipment_return_id = $return->id;
            $replacement->shipment_id = $return->shipment_id;
            $replacement->order_id = $return->order_id;
            $replacement->agent_id = $return->agent_id;
            $replacement->source_id = $return->source_id;
            $replacement->mobile = $return->mobile;
            $replacement->address = $return->address;
            $replacement->total_shipment_price = $return->total_shipment_price;
            $replacement->total_return_price = $return->total_return_price;
            $replacement->save();

            $replaceAmount = 0;

            foreach ($return->items as $item) {
                $item->confirmed = 1;
                $item->save();

                if ($item->return_type == 'refund') {


                } else {
                    $replaceItem = new ProductReplacementItem;
                    $replaceItem->product_replacement_id = $replacement->id;
                    $replaceItem->shipment_return_id = $return->id;
                    $replaceItem->shipment_return_item_id = $item->id;
                    $replaceItem->shipment_id = $item->shipment_id;
                    $replaceItem->shipment_item_id = $item->shipment_item_id;
                    $replaceItem->order_id = $item->order_id;
                    $replaceItem->order_item_id = $item->order_item_id;
                    $replaceItem->product_id = $item->product_id;
                    $replaceItem->product_name = $item->product_name;
                    $replaceItem->seller_source_id = $item->seller_source_id;
                    $replaceItem->buyer_source_id = $item->buyer_source_id;
                    $replaceItem->depo_id = $item->depo_id;
                    $replaceItem->distributor_id = $item->distributor_id;
                    $replaceItem->dealer_id = $item->dealer_id;
                    $replaceItem->agent_id = $item->agent_id;
                    $replaceItem->division_id = $item->division_id;
                    $replaceItem->district_id = $item->district_id;
                    $replaceItem->upazila_id = $item->upazila_id;
                    $replaceItem->upazila_id = $item->upazila_id;
                    $replaceItem->market_id = $item->market_id;
                    $replaceItem->return_reason = $item->return_reason;
                    $replaceItem->order_quantity = $item->order_quantity;
                    $replaceItem->shipment_quantity = $item->shipment_quantity;
                    $replaceItem->return_quantity = $item->return_quantity;
                    $replaceItem->replace_quantity = $item->return_quantity;
                    $replaceItem->unit_price = $item->unit_price;
                    $replaceItem->shipment_amount = $item->shipment_amount;
                    $replaceItem->return_amount = $item->return_amount;
                    $replaceItem->replace_amount = round(($replaceItem->replace_quantity * $replaceItem->unit_price), 2);
                    $replaceItem->return_at = $item->return_at;
                    $replaceItem->save();

                    $replaceAmount = $replaceAmount + $replaceItem->replace_amount;
                }
            }
            if ($replacement->items->count() > 0) {
                $replacement->total_replacement_price = $replaceAmount;
                $replacement->save();
            } else {
                $replacement->delete();
            }

        }
        if ($status == 'rejected') {
            $return->return_status = $status;
            $return->editedby_id = auth()->user()->id;
            $return->save();
        }

        return redirect()->back()->with('success', 'Shipment Return status is updated.');
    }
}
