<?php

namespace App\Http\Controllers\Web\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceCategory;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use App\Models\ShopCommission;
use Illuminate\Http\Request;

class AdminSourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EcommerceSource $shop)
    {
        menuSubmenu('shops', 'allShops');
        $shops = $shop->latest()->paginate(50);
        // dd($shops);
        return view('admin.ecommerce.shop.index', [
            'shops' => $shops,
        ]);
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
    public function edit(EcommerceSource $shop)
    {
        menuSubmenu('shops', 'allShops');
        $categories = EcommerceCategory::where('active', 1)->get();
        $agents= Agent::orderBy('name')->get();

        return view('admin.ecommerce.shop.edit', [
            'shop' => $shop,
            'categories' => $categories,
            'agents'=>$agents
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EcommerceSource $shop, Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'mobile' => 'required|string|numeric|unique:ecommerce_sources,mobile,'.$shop->mobile.',mobile',
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
        ]);

        // $toalSale = ($shop->total_sale - $shop->initial_amount) + $request->due_amount;
        // $toalCurSale = ($shop->current_sale - $shop->initial_amount) + $request->due_amount;
        $shop->name = $request->name;
        $shop->owner_name = $request->owner_name;
        $shop->agent_id = $request->agent;
        $shop->mobile = $request->mobile;
        $shop->description = $request->description;
        $shop->address = $request->address;
        $shop->due_amount = $request->due_amount ?? $shop->due_amount;
        if (!$shop->initial_amount || $shop->initial_amount < 1) {
            $shop->initial_amount = $request->due_amount ?? $shop->due_amount;
        }
        $shop->monthly_target = $request->monthly_target ?? 0;
        $shop->active = $request->active ? 1 : 0;
        $shop->save();

        foreach ($request->all() as $key => $value) {
            $cat = str_split($key, 9);
            if ($cat[0] == 'category_' && $value > 0) {
                $categoryId = intval($cat[1]);
                $shopCom = ShopCommission::where('category_id', $categoryId)->where('source_id', $shop->id)->first();
                if (!$shopCom) {
                    $shopCom = new ShopCommission;
                }
                $shopCom->source_id = $shop->id;
                $shopCom->category_id = $categoryId;
                $shopCom->commission = $value;
                $shopCom->editedby_id = auth()->user()->id;
                $shopCom->save();
            }
        }

        return redirect()->back()->with('success', 'Shop is updated');
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
    public function orderList(EcommerceSource $shop)
    {
        menuSubmenu('shops', 'allShops');
        $orders = $shop->orders()->paginate(50);
        return view('admin.ecommerce.shop.orderList', [
            'shop' => $shop,
            'orders' => $orders,
        ]);
    }
    public function collectionList(EcommerceSource $shop)
    {
        menuSubmenu('shops', 'allShops');
        $collections = $shop->collections()->paginate(50);
        return view('admin.ecommerce.shop.collectionList', [
            'shop' => $shop,
            'collections' => $collections,
        ]);
    }
    public function retutnList(EcommerceSource $shop)
    {
        menuSubmenu('shops', 'allShops');
        $returns = $shop->returns()->paginate(50);
        return view('admin.ecommerce.shop.returnList', [
            'shop' => $shop,
            'returns' => $returns,
        ]);
    }
    public function comissionList(EcommerceSource $shop)
    {
        menuSubmenu('shops', 'allShops');
        $commissions = $shop->commissions()->paginate(50);
        return view('admin.ecommerce.shop.commissionList', [
            'shop' => $shop,
            'commissions' => $commissions,
        ]);
    }
}
