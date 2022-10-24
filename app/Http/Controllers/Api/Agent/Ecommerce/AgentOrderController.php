<?php

namespace App\Http\Controllers\Api\Agent\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommerceOrderItem;
use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use App\Models\SaleCommission;
use App\Models\Shipment;
use App\Models\ShipmentItem;
use App\Models\ShipmentReturn;
use App\Models\ShipmentReturnItem;
use App\Models\SrOrder;
use App\Models\SrOrderItem;
use App\Models\WebsiteBalance;
use Illuminate\Http\Request;

class AgentOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Agent $agent)
    {
        $orders = $agent->orders()->latest()->paginate(20);
        return response()->json($orders, 200);
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
    public function orderPlace(Agent $agent, Request $request)
    {
        $source = EcommerceSource::find($request->source);
        $ecoOrder = new EcommerceOrder;
        // $ecoOrder->user_id = $request->user['id'];
        $ecoOrder->depo_id = $agent->depo_id;
        $ecoOrder->distributor_id = $agent->distributor_id;
        $ecoOrder->dealer_id = $agent->dealer_id;
        $ecoOrder->agent_id = $agent->id;
        $ecoOrder->division_id = $agent->division_id;
        $ecoOrder->district_id = $agent->district_id;
        $ecoOrder->upazila_id = $agent->upazila_id;
        $ecoOrder->market_id = $source->market_id ?? null;
        $ecoOrder->address = $source->address;
        $ecoOrder->source_id = $source->id ?? null;
        $ecoOrder->mobile = $source->mobile ?? null;
        $ecoOrder->pending_at = now();
        $ecoOrder->save();

        $srOrder = new SrOrder;
        $srOrder->order_id = $ecoOrder->id;
        $srOrder->depo_id = $ecoOrder->depo_id ?? null;
        $srOrder->dealer_id = $ecoOrder->dealer_id ?? null;
        $srOrder->agent_id = $ecoOrder->agent_id ?? null;
        $srOrder->market_id = $ecoOrder->market_id ?? null;
        $srOrder->address = $ecoOrder->address ?? null;
        $srOrder->source_id = $ecoOrder->source_id ?? null;
        $srOrder->mobile = $ecoOrder->mobile ?? null;
        $srOrder->pending_at = $ecoOrder->pending_at ?? null;
        $srOrder->save();

        $price = 0.00;
        $collection = 0.00;

        foreach ($request->products as $product) {
            $prod = EcommerceProduct::find($product["id"]);
            $unitPrice = $prod->priceByQuantity($product["order_quantity"]);

            $itemPrice = $unitPrice*$product['order_quantity'];

            $orderItem = new EcommerceOrderItem;

            if ($prod->pice) {
                if ($prod->pice > $product["order_quantity"]) {
                    $orderItem->bonus = 0;
                }
                $bonus= ($prod->bonus * $product["order_quantity"]) / $prod->pice ;
                $orderItem->bonus = (int) $bonus;
            }else{
                $orderItem->bonus = 0;
            }


            $orderItem->order_id = $ecoOrder->id;
            $orderItem->product_id = $product["id"];
            $orderItem->category_id = $prod->category_id;
            $orderItem->product_name = $prod->name;
            $orderItem->total_quantity = $product["order_quantity"];
            $orderItem->unit_price = $unitPrice;
            $orderItem->total_price = $itemPrice;
            // $orderItem->user_id = $product["user_id"];
            $orderItem->seller_source_id = $srOrder->source_id ?? null;
            $orderItem->buyer_source_id = $srOrder->source_id ?? null;
            $orderItem->depo_id = $srOrder->depo_id ?? null;
            $orderItem->distributor_id = $srOrder->distributor_id ?? null;
            $orderItem->dealer_id = $srOrder->dealer_id ?? null;
            $orderItem->agent_id = $srOrder->agent_id ?? null;
            $orderItem->market_id = $srOrder->market_id ?? null;
            $shop_commission = $source->commissionByProduct($prod->id);
            $orderItem->percent_commision= $shop_commission;
            $shop_payment = round($orderItem->total_price - (($orderItem->total_price/100)*$shop_commission), 2);

            $orderItem->collection_amount = $shop_payment;

            $orderItem->save();



            $srOrderItem = new SrOrderItem;
            $srOrderItem->sr_order_id = $srOrder->id;
            $srOrderItem->order_id = $orderItem->order_id;
            $srOrderItem->product_id = $orderItem->product_id;
            $srOrderItem->product_name = $orderItem->product_name;
            $srOrderItem->total_quantity = $orderItem->total_quantity;
            $srOrderItem->unit_price = $orderItem->unit_price;
            $srOrderItem->total_price = $orderItem->total_price;
            $srOrderItem->collection_amount = $orderItem->collection_amount;
            $srOrderItem->seller_source_id = $orderItem->seller_source_id;
            $srOrderItem->buyer_source_id = $orderItem->buyer_source_id;
            $srOrderItem->depo_id = $orderItem->depo_id;
            $srOrderItem->distributor_id = $orderItem->distributor_id;
            $srOrderItem->dealer_id = $orderItem->dealer_id;
            $srOrderItem->agent_id = $orderItem->agent_id;
            $srOrderItem->division_id = $orderItem->division_id;
            $srOrderItem->district_id = $orderItem->district_id;
            $srOrderItem->upazila_id = $orderItem->upazila_id;
            $srOrderItem->market_id = $orderItem->market_id;
            $srOrderItem->percent_commision = $orderItem->percent_commision;
            $srOrderItem->save();

            $price = $price+$itemPrice;
            $collection = $collection+$orderItem->collection_amount;
        }

        $ecoOrder->total_price = $price;
        $ecoOrder->total_collection_amount = $collection;
        $ecoOrder->save();

        $srOrder->total_price = $ecoOrder->total_price;
        $srOrder->total_collection_amount = $ecoOrder->total_collection_amount;
        $srOrder->save();

        return response()->json($ecoOrder, 200);
    }
    public function orderDetails(Agent $agent, EcommerceOrder $order)
    {
        $orderDetails = $order->load('orderForUser', 'orderForSource', 'items');
        return response()->json($orderDetails, 200);
    }

    public function orderShipments(Agent $agent, EcommerceOrder $order)
    {
        $data = $order->shipments->load('items');
        return response()->json($data, 200);
    }

    public function orderShipmentDetails(Agent $agent, EcommerceOrder $order, Shipment $shipment, ShipmentReturn $return)
    {
        $shipmentData = $shipment->find($shipment->id)->load('items');
        $data = ['order' => $order, 'shipment' => $shipmentData];
        return response()->json($data, 200);
    }

    public function orderShipmentReturnPost(Agent $agent, EcommerceOrder $order, Shipment $shipment, ShipmentReturn $return, Request $request)
    {
        if ($request->quantities) {
            $returnReq = new ShipmentReturn;
            $returnReq->shipment_id = $shipment->id;
            $returnReq->order_id = $order->id;
            $returnReq->agent_id = $order->agent_id;
            $returnReq->source_id = $order->source_id;
            $returnReq->mobile = $order->mobile;
            $returnReq->address = $order->address;
            $returnReq->total_quantity = $order->total_quantity;
            $returnReq->total_price = $shipment->total_price;
            $returnReq->total_shipment_price = $shipment->shipment_price ?? 0;
            $returnReq->reason = $request->reason ?? '';
            $returnReq->return_status = 'pending';
            $returnReq->return_at = now();
            $returnReq->agent_id = $agent->id;
            $returnReq->shipped_at = $shipment->shipped_at;
            $returnReq->addedby_id = auth()->user()->id;
            $returnReq->save();

            $totalReturnAmount = 0;

            foreach ($request->quantities as $key => $value) {
                if ($value) {
                    $shipmentItem = ShipmentItem::Find($key);
                    if ($shipment->id == $shipmentItem->shipment_id) {
                        $returnReqItem = new ShipmentReturnItem;
                        $returnReqItem->shipment_return_id = $returnReq->id;
                        $returnReqItem->shipment_id = $shipment->id;
                        $returnReqItem->shipment_item_id = $shipmentItem->id;
                        $returnReqItem->order_id = $order->id;
                        $returnReqItem->order_item_id = $shipmentItem->order_item_id;
                        $returnReqItem->product_id = $shipmentItem->product_id;
                        $returnReqItem->product_name = $shipmentItem->product_name;
                        $returnReqItem->seller_source_id = $shipmentItem->seller_source_id;
                        $returnReqItem->buyer_source_id = $shipmentItem->buyer_source_id;
                        $returnReqItem->depo_id = $shipmentItem->depo_id;
                        $returnReqItem->distributor_id = $shipmentItem->distributor_id;
                        $returnReqItem->dealer_id = $shipmentItem->dealer_id;
                        $returnReqItem->agent_id = $shipmentItem->agent_id;
                        $returnReqItem->division_id = $shipmentItem->division_id;
                        $returnReqItem->district_id = $shipmentItem->district_id;
                        $returnReqItem->upazila_id = $shipmentItem->upazila_id;
                        $returnReqItem->market_id = $shipmentItem->market_id;
                        $returnReqItem->return_type = $request->types[$key] ?? null;
                        $returnReqItem->return_reason = $request->reasons[$key] ?? null;
                        $returnReqItem->order_quantity = $shipmentItem->total_quantity;
                        $returnReqItem->shipment_quantity = $shipmentItem->shipment_quantity;
                        $returnReqItem->return_quantity = $value;
                        $returnReqItem->unit_price = $shipmentItem->unit_price;
                        $returnReqItem->shipment_amount = $shipmentItem->shipment_amount ?? 0;
                        $returnReqItem->return_amount = floatval($value)*$shipmentItem->unit_price;
                        $returnReqItem->unit_discount = $shipmentItem->unit_discount;
                        $returnReqItem->total_discount = $shipmentItem->total_discount;
                        $returnReqItem->addedby_id = auth()->user()->id;
                        $returnReqItem->return_at = $returnReq->return_at;

                        $returnReqItem->save();

                        $totalReturnAmount = $totalReturnAmount +$returnReqItem->return_amount;
                    }
                }
            }

            $returnReq->total_return_price = $totalReturnAmount;
            $returnReq->save();
        }
        return response()->json($returnReq, 200);
    }

    public function orderShipmentCollected(Agent $agent, EcommerceOrder $order, Shipment $shipment)
    {
        $shipment->order_status = 'collected';
        $shipment->collected_at = now();
        $shipment->save();

        $order->order_status = 'collected';
        $order->collected_at = $shipment->collected_at;
        $order->save();

        return response()->json($shipment, 200);
    }

    public function orderShipmentDelivered(Agent $agent, EcommerceOrder $order, Shipment $shipment)
    {
        if ($shipment->order_status == 'collected') {
            $shipment->order_status = 'delivered';
            $shipment->delivered_at = now();
            $shipment->save();

            $order->order_status = 'delivered';
            $order->delivered_at = $shipment->delivered_at;
            $order->save();
            $totalSrCommission = 0;
            $totalShopCommission = 0;
            $totalSysBal = 0;
            foreach ($shipment->items as $item) {
                $commission = new SaleCommission;
                $commission->order_id       = $item->order_id;
                $commission->order_item_id  = $item->order_item_id;
                $commission->shipment_id    = $item->shipment_id;
                $commission->shipment_item_id = $item->id;
                $commission->agent_id       = $item->agent_id;
                $commission->source_id      = $item->seller_source_id;
                $commission->total_price    = $item->shipment_amount;
                $commission->collection_amount    = $item->collection_amount;
                $commission->product_id      = $item->product_id;
                $commission->delivered_quantity = $item->shipment_quantity;


                $commission->shop_commission = $item->source->commissionByProduct($item->product_id);
                $commission->shop_monthly_target = $item->source->monthly_target;
                $commission->shop_amount = round(($commission->total_price/100)*$commission->shop_commission, 2);

                $commission->sr_commission = $item->agent->commissionByProduct($item->product_id);
                $commission->sr_monthly_target = $item->agent->monthly_target;
                $commission->sr_amount = round((($commission->total_price-$commission->shop_amount)/100)*$commission->sr_commission, 2);
                $commission->system_balance = $commission->total_price - ($commission->sr_amount+$commission->shop_amount);

                $commission->tr_date = now();
                $commission->save();

                $totalSrCommission = round($totalSrCommission + $commission->sr_amount, 2);
                $totalShopCommission = round($totalShopCommission + $commission->shop_amount, 2);
                $totalSysBal = $totalSysBal + $commission->system_balance;
            }
            $orderByAgent = $shipment->orderByAgent;
            $orderForSource = $shipment->orderForSource;

            $orderByAgent->total_sale = $orderByAgent->total_sale+$shipment->total_collection_amount;
            $orderByAgent->current_sale = $orderByAgent->current_sale+$shipment->total_collection_amount;
            $orderByAgent->total_sale_commission = $orderByAgent->total_sale_commission+$totalSrCommission;
            $orderByAgent->current_sale_commission = $orderByAgent->current_sale_commission+$totalSrCommission;
            $orderByAgent->save();

            $orderForSource->total_sale = $orderForSource->total_sale+$shipment->total_collection_amount;
            $orderForSource->current_sale = $orderForSource->current_sale+$shipment->total_collection_amount;
            $orderForSource->total_sale_commission = $orderForSource->total_sale_commission+$totalShopCommission;
            $orderForSource->current_sale_commission = $orderForSource->current_sale_commission+$totalShopCommission;
            $orderForSource->save();

            $system = WebsiteBalance::first();
            $system->system_balance = $system->system_balance+$totalSysBal;
            $system->save();

            return response()->json($shipment, 200);
        }
    }



}
