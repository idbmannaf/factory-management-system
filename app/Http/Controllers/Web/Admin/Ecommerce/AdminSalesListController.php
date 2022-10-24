<?php

namespace App\Http\Controllers\Web\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Services\ImageFilter;
use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceSalesListProduct;
use App\Models\Ecommerce\SalesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminSalesListController extends Controller
{
    use ImageFilter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SalesList $sl)
    {
        menuSubmenu('ecommerce', 'salesList');
        $salesList = $sl->paginate(20);
        return view('admin.ecommerce.salesList.index', [
            'salesList' => $salesList,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        menuSubmenu('ecommerce', 'salesList');
        return view('admin.ecommerce.salesList.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalesList $list, Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'name_en' => 'required|max:100',
            'description_en' => 'required|max:100',
            'icon' => 'image',
            'banner' => 'image',
        ]);
        if (!$list->img_name) {
            $this->validate($request,[
                'icon' => 'required',
            ]);
        }
        $list->name = ['en' => $request->name_en, 'bn' => $request->name_bn ?? ''];
        $list->description = ['en' => $request->description_en, 'bn' => $request->description_bn ?? ''];

        if ($request->hasFile('icon')) {
            if ($list->img_name) {
                $delImg = ltrim($list->img_name, url('/').'/storage');
                $delImg = '/public'.$delImg;
                Storage::delete($delImg);
            }
            $icon = $this->resize($request->icon, 100, 100);
            $time   = Str::slug(now());
            $imgName = Str::slug($request->name_en).'_'.$time;
            $icon->storeAs('salesList', $imgName, 'public'); //uploading on storage

            $list->img_name = url('/').'/storage/salesList/'.$imgName; //saving the image link

        }

        if ($request->hasFile('banner')) {
            if ($list->banner_name) {
                $delImg = ltrim($list->banner_name, url('/').'/storage');
                $delImg = '/public'.$delImg;
                Storage::delete($delImg);
            }
            $banner = $this->resize($request->banner, 600, 300);
            $time   = Str::slug(now());
            $imgName = Str::slug($request->name_en).'_'.$time;
            $banner->storeAs('salesList', $imgName, 'public'); //uploading on storage

            $list->banner_name = url('/').'/storage/salesList/'.$imgName; //saving the image link
        }
        $list->active = $request->active ? true : false;
        $list->save();

        if ($request->products && count($request->products) > 0) {
            foreach ($request->products as $product) {
                $chkListProduct = EcommerceSalesListProduct::where('sales_list_id', $list->id)->where('product_id', $product)->first();
                if (!$chkListProduct) {
                    $salesListProduct = new EcommerceSalesListProduct;
                    $salesListProduct->sales_list_id = $list->id;
                    $salesListProduct->product_id = $product;
                    $salesListProduct->addedby_id = auth()->user()->id;
                    $salesListProduct->save();
                }
            }
        }

        return redirect()->route('admin.ecommerce.salesLists')->with('success', 'Sales List Saved Successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesList $list)
    {
        menuSubmenu('ecommerce', 'salesList');
        return view('admin.ecommerce.salesList.create', [
            'list' => $list,
        ]);
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
    public function destroy(SalesList $list)
    {
        if ($list->items->count() > 0) {
            foreach ($list->items as $item) {
                $item->delete();
            }
        }
        $list->delete();

        return redirect()->back()->with('success', 'List was deleted successfully.');
    }
    public function searchProduct(Request $request)
    {
        $products = EcommerceProduct::where('name->en', 'like', '%' . $request->q . '%')
        // ->orWhere('excerpt', 'like', '%'.$request->q.'%')
        // ->orWhere('description', 'like', '%'.$request->q.'%')
            ->orWhere('what_in_box', 'like', '%' . $request->q . '%')
            // ->select(['id', DB::raw('IFNULL(email, mobile) as email')])
        // ->select(['id','email','mobile'])
            ->take(30)->get();
        if ($products->count()) {
            if ($request->ajax()) {
                // return Response()->json(['items'=>$users]);
                return $products;
            }
        } else {
            if ($request->ajax()) {
                return $products;
            }
        }
        return $products;
    }
    public function detachProduct(EcommerceSalesListProduct $listItem, EcommerceProduct $product)
    {
        $listItem->delete();
        return redirect()->back()->with('success', "{$product->name} is detached from the list")->withInput();
    }
}
