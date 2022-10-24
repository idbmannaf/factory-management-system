<?php

namespace App\Http\Controllers\Api\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceCategory;
use App\Models\Ecommerce\EcommerceProduct;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EcommerceProduct $product)
    {
        $products = $product->productsForCustomer()->latest()->paginate(6);

        return response()->json($products, 200);
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

    public function recentlyViewedProducts(EcommerceProduct $product)
    {
        $products = $product->productsForCustomer()->inRandomOrder()->take(6)->get();
        return response()->json($products, 200);
    }
    public function bestDealProducts(EcommerceProduct $product)
    {
        $products = $product->productsForCustomer()->inRandomOrder()->take(6)->get();
        return response()->json($products, 200);
    }
    public function getProduct(EcommerceProduct $product)
    {
        $data = $product->load('owner','source','categories','prices')->toArray();
        $relatedItems = $product->productsForCustomer()->inRandomOrder()->take(6)->get()->toArray();
        $data['related_items'] = $relatedItems;
        $cart = $product->findCart();
        if ($cart) {
            $data['isCarted'] = true;
            $data['cart'] = $cart;
        }else{
            $data['isCarted'] = false;
        }
        return response()->json($data, 200);
    }
    public function getCategories(EcommerceCategory $category)
    {
        $data = $category->whereIsRoot()->paginate(10);
        return response()->json($data, 200);
    }
    public function getSubCategories(EcommerceCategory $category)
    {
        $data = $category->descendantsAndSelf($category->id)->toTree()->first();
        $data['parents'] = $category->ancestors;
        return response()->json($data, 200);
    }
}
