<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommercePaymentCollection;
use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\SaleCommission;
use App\Models\ShipmentReturn;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSearchController extends Controller
{
    public function search($type, Request $request)
    {
        if ($type == 'shop') {
            $shops = EcommerceSource::where('name', 'LIKE', "%{$request->q}%")->orWhere('owner_name', 'LIKE', "%{$request->q}%")->orWhere('mobile', 'LIKE', "%{$request->q}%")->take(100)->get();
            return view('admin.ecommerce.shop.parts.shopsTableBody', [
                'shops' => $shops,
                'type' => $type,
            ]);
        }elseif($type == 'order'){
            $orders = EcommerceOrder::where('id', 'LIKE', "%{$request->q}%")->orWhereHas('orderForSource', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('mobile', 'like', '%'.$request->q.'%');
            })->orWhereHas('orderByAgent', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%');
            })->take(100)->get();

            return view('admin.ecommerce.order.parts.orderTableBody', [
                'orders' => $orders,
                'type' => $type,
            ]);
        }elseif($type == 'product'){
            $products = EcommerceProduct::where(function ($query) use ($request){
                $query->where('id', 'LIKE', "%{$request->q}%")
                    ->orWhere('name', 'LIKE', "%{$request->q}%");
            })->orWhereHas('category', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%');
            })->take(100)->get();

            return view('admin.ecommerce.product.parts.productTableBody', [
                'products' => $products,
                'type' => $type,
            ]);
        }elseif($type == 'return'){
            $returns = ShipmentReturn::where(function ($query) use ($request){
                $query->where('id', 'LIKE', "%{$request->q}%");
            })->orWhereHas('sr', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%');
            })->orWhereHas('source', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('mobile', 'like', '%'.$request->q.'%');
            })->take(100)->get();

            return view('admin.ecommerce.return.parts.returnTableBody', [
                'returns' => $returns,
                'type' => $type,
            ]);
        }elseif($type == 'collection'){
            $collections = EcommercePaymentCollection::where(function ($query) use ($request){
                $query->where('id', 'LIKE', "%{$request->q}%");
            })->orWhereHas('agent', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%');
            })->orWhereHas('source', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('mobile', 'like', '%'.$request->q.'%');
            })->take(100)->get();

            return view('admin.ecommerce.collection.parts.collectionTableBody', [
                'collections' => $collections,
                'type' => $type,
            ]);
        }elseif($type == 'commission'){
            $commissions = SaleCommission::where(function ($query) use ($request){
                $query->where('id', 'LIKE', "%{$request->q}%")
                    ->orWhere('order_id', 'LIKE', "%{$request->q}%")
                    ->orWhere('product_id', 'LIKE', "%{$request->q}%");
            })->orWhereHas('agent', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%');
            })->orWhereHas('source', function ($query) use ($request){
                $query->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('mobile', 'like', '%'.$request->q.'%');
            })->take(100)->get();

            return view('admin.ecommerce.commission.parts.commissionTableBody', [
                'commissions' => $commissions,
                'type' => $type,
            ]);
        }elseif($type == 'user'){
            $users = User::where(function ($query) use ($request){
                $query->where('name', 'LIKE', "%{$request->q}%")
                    ->orWhere('mobile', 'LIKE', "%{$request->q}%")
                    ->orWhere('nid', 'LIKE', "%{$request->q}%");
            })->take(100)->get();

            return view('admin.ecommerce.user.parts.userTableBody', [
                'users' => $users,
                'type' => $type,
            ]);
        }else {
            # code...
        }

    }
}
