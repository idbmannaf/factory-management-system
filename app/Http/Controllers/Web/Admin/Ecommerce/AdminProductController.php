<?php

namespace App\Http\Controllers\Web\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceCategory;
use App\Models\Ecommerce\EcommerceCatProduct;
use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function Ramsey\Uuid\v1;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EcommerceProduct $product)
    {
        menuSubmenu('ecommerce', 'products');
        $products = $product->where('status','<>', 'temp')->with('owner','prices','source')->latest()->paginate(20);
        return view('admin.ecommerce.product.index',[
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EcommerceCategory::where('active', true)->get();
        // $categories = EcommerceCategory::whereIsRoot()->where('active', true)->get();
        return view('admin.ecommerce.product.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EcommerceProduct $product, Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required|max:255',
            'excerpt_en' => 'required|max:300',
            'min_order_qty' => 'required|numeric',
            'purchase_price' => 'numeric',
            'sale_price' => 'required|numeric',
            'category' => 'required',
            'image' => 'image|max:512',
        ]);
        // dd($request->all());
        $product->name = ['en' => $request->name_en, 'bn' => $request->name_bn ?? ''];
        $product->excerpt = ['en'=> $request->excerpt_en, 'bn' => $request->excerpt_bn ?? ''];
        $product->description = ['en'=> $request->description_en, 'bn' => $request->description_bn ?? ''];
        $product->what_in_box = ['en'=> $request->what_in_box_en, 'bn' => $request->what_in_box_bn ?? ''];
        $product->septic = $request->septic ? true : false;
        $product->liquid = $request->liquid ? true : false;
        $product->inflammable = $request->inflammable ? true : false;
        $product->pre_order = $request->pre_order ? true : false;
        $product->category_id = $request->category;
        $product->digital = $request->digital ? true : false;
        $product->refundable = $request->refundable ? true : false;
        $product->warrenty_type = $request->warrenty_type ?? '';
        $product->bonus = $request->bonus ?? 0;
        $product->pice = $request->pice ?? 0;
        $product->purchase_price = $request->purchase_price ?? '';
        $product->sale_price = $request->sale_price ?? '';
        $product->status = 'published';
        $product->type = $request->type;
        $product->type_value = $request->type_value;
        $product->unit = $request->unit;
        $product->unit_value = $request->unit_value;
        $product->addedby_id = auth()->user()->id;
        $product->save();
        if ($request->hasFile('image')) {
            $cp = $request->image;
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $product->id.'_fi_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;
            $cp->storeAs('product/fi',$randomFileName , 'public');

            $product->feature_img = url('/').'/storage'.'/product/fi/'.$randomFileName;
            $product->save();
        }
        if ($request->category) {
            $prodCat = new EcommerceCatProduct;
            $prodCat->product_id = $product->id;
            $prodCat->category_id = $request->category;
            $prodCat->addedby_id = auth()->user()->id;
            $prodCat->save();
        }
        return redirect()->back()->with('success', 'Product is added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EcommerceProduct $product)
    {
        return view('admin.ecommerce.product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EcommerceProduct $product)
    {
        $categories = EcommerceCategory::where('active', true)->get();
        return view('admin.ecommerce.product.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EcommerceProduct $product)
    {
        $this->validate($request, [
            'name_en' => 'required|max:255',
            'excerpt_en' => 'required|max:300',
            'min_order_qty' => 'required|numeric',
            'purchase_price' => 'numeric',
            'sale_price' => 'required|numeric',
            'category' => 'required',
        ]);

        $product->name = ['en' => $request->name_en, 'bn' => $request->name_bn ?? ''];
        $product->excerpt = ['en'=> $request->excerpt_en, 'bn' => $request->excerpt_bn ?? ''];
        $product->description = ['en'=> $request->description_en, 'bn' => $request->description_bn ?? ''];
        $product->what_in_box = ['en'=> $request->what_in_box_en, 'bn' => $request->what_in_box_bn ?? ''];
        $product->septic = $request->septic ? true : false;
        $product->liquid = $request->liquid ? true : false;
        $product->category_id = $request->category;
        $product->inflammable = $request->inflammable ? true : false;
        $product->pre_order = $request->pre_order ? true : false;
        $product->digital = $request->digital ? true : false;
        $product->refundable = $request->refundable ? true : false;
        $product->bonus = $request->bonus ?? 0;
        $product->pice = $request->pice ?? 0;
        $product->min_order_quantity = $request->min_order_qty ?? '';
        $product->purchase_price = $request->purchase_price ?? '';
        $product->sale_price = $request->sale_price ?? '';
        // $product->save();
        $product->type = $request->type;
        $product->type_value = $request->type_value;
        $product->unit = $request->unit;
        $product->unit_value = $request->unit_value;

        $category= EcommerceCategory::find($product->category_id);
        $product->cat_title = $category->name;
        $product->save();

        if ($request->hasFile('image')) {
            if ($product->feature_img) {
                $n = $product->feature_img;
                $d = url('/').'/storage';
                $img = ltrim($n,$d);
                $img = 'public/pro'.$img; // idk why this 'pro' was trimmed earlier
                // dd($img);
                Storage::delete($img);
            }

            $cp = $request->image;
            $extension = strtolower($cp->getClientOriginalExtension());
            $randomFileName = $product->id.'_fi_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;
            $cp->storeAs('product/fi',$randomFileName , 'public');

            $product->feature_img = url('/').'/storage'.'/product/fi/'.$randomFileName;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product is updated successfully!');
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
    public function publish(EcommerceProduct $product)
    {
        $product->status = 'published';
        $product->editedby_id = auth()->user()->id;
        $product->save();

        return true;
    }

    public function priceUpdate(EcommerceProduct $product, EcommerceProductPrice $price, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'min_unit' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 209);
        }
        if (!$price->product_id) {
            $price->product_id = $product->id;
        }
        $price->min_unit = $request->min_unit;
        $price->purchase_price = $request->purchase_price;
        $price->sale_price = $request->sale_price;
        $price->save();
        return response()->json($price, 200);
    }
}
