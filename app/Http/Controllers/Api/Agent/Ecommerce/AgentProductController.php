<?php

namespace App\Http\Controllers\Api\Agent\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\ProductDetailsRequest;
use App\Http\Requests\Ecommerce\ProductImageRequest;
use App\Models\Ecommerce\EcommerceCategory;
use App\Models\Ecommerce\EcommerceCatProduct;
use App\Models\Ecommerce\EcommerceOrder;
use App\Models\Ecommerce\EcommerceOrderItem;
use App\Models\Ecommerce\EcommerceProduct;
use App\Models\Ecommerce\EcommerceProductMedia;
use App\Models\Ecommerce\EcommerceProductPrice;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Ecommerce\SalesList;
use App\Models\User;
use App\Models\Role\Agent;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class AgentProductController extends Controller
{

    public $eCommerceProduct;

    public function __construct(EcommerceProduct $eCommerceProduct)
    {
        $this->eCommerceProduct = $eCommerceProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Agent $agent)
    {
        $products = $this->eCommerceProduct->getAllProducts($agent,20);
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Agent $agent)
    {
        return $this->eCommerceProduct->fetchOrCreateTemp($agent);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Agent $agent, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:255',
            'excerpt' => 'required|max:300',
            'product_condition' => 'required',
        ]);
        if ($validator->fails()) {
          return response()->json($validator->errors(), 209);
        }
        // dd($request->all());
        $newProduct = $this->create($agent);

        $newProduct->name = ['en' => $request->product_name, 'bn' => $request->product_name_bn ?? ''];
        $newProduct->excerpt = ['en'=> $request->excerpt, 'bn' => $request->excerpt_bn ?? ''];
        $newProduct->description = ['en'=> $request->description, 'bn' => $request->description_bn ?? ''];
        $newProduct->what_in_box = ['en'=> $request->what_in_box, 'bn' => $request->what_in_box ?? ''];
        $newProduct->product_condition = $request->product_condition;
        $newProduct->septic = $request->septic ?? false;
        $newProduct->liquid = $request->liquid ?? false;
        $newProduct->inflammable = $request->inflammable ?? false;
        $newProduct->pre_order = $request->pre_order ?? false;
        $newProduct->digital = $request->digital ?? false;
        $newProduct->refundable = $request->refundable ?? false;
        $newProduct->warrenty_type = $request->warrenty_type ?? '';
        $newProduct->warrenty_period = $request->warrenty_period ?? '';
        $newProduct->save();
        return response()->json($newProduct);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        // return 1;
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

    public function productDetails(Agent $agent, EcommerceProduct $product)
    {
        $productDetails = $product->load('owner', 'source');

        return response()->json($productDetails, 200);
    }

    public function productFeatureImageChange(Agent $agent, Request $request)
    {
        if ($request->hasFile('image')) {
            $mime =$request->image->getClientMimeType();
            if ($mime == "image/webp" || $mime == "image/jpeg" || $mime == "image/png" ) {
            $newProduct = $this->create($agent);

            $cp = $request->file('image');
            $cw= (int) $request->cropWidth;
            $ch = (int) $request->cropHeight;
            $x = $request->cropLeft > 0 ? (int) $request->cropLeft : 0;
            $y = $request->cropTop > 0 ? (int) $request->cropTop : 0;
            $extension = strtolower($cp->getClientOriginalExtension());
            $mime = $cp->getClientMimeType();
            $size =$cp->getSize();
            $randomFileName = $newProduct->id.'_fi_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            // list($originalWidth,$originalHeight) = getimagesize($cp);

            // if($originalWidth == '200' && $originalHeight == '200')
            // {
            //     Storage::disk('upload')
            //     ->put('users/pp/'.$randomFileName, File::get($cp));
            //             //pfi = product feature image
            // }
            // else if($originalWidth == '160' && $originalHeight == '160')
            // {
            //     Storage::disk('upload')
            //     ->put('users/pp/'.$randomFileName, File::get($cp));
            //             //pfi = product feature image
            // }
            // else
            // {
                $temp = $cp->getPathName();
                $image = Image::make($temp)
                ->crop($cw, $ch, $x, $y)
                ->resize(640, 640)
                // ->save(public_path().'/storage/product/fi/'.$randomFileName, 100);
                // ->save(().'/storage/product/fi/'.$randomFileName, 100)
                ;

               # $watermark = Image::make(public_path('/img/msbd3.png'));
               # $image->insert($watermark);

                // $image->insert($watermark, 'bottom-right', 10, 10);
                // $image->mask($watermark, true);
                // $image->fill($watermark, 0, 0);
                // $image->save(public_path().'/storage/users/pp/'.$randomFileName, 90);
                $image->save($temp,90,$extension);

                // $originalWidth = $image->width();
                // $originalHeight = $image->height();

                $image->destroy();

            // }

            #update old rows of profilepic
            // $oldRows = $user->userPictures()
            // ->whereImageType('profilepic')
            // ->whereAutoload(true)
            // ->update([
            //     'autoload'=>false,
            //     'editedby_id' => Auth::id()
            // ]);

            #delete old rows of profilepic

            if($newProduct->feature_img)
            {
                // $f = 'product/fi/'.$newProduct->feature_img;
                // if(Storage::disk('upload')->exists($f))
                // {
                //     Storage::disk('upload')->delete($f);
                // }
                $n = $newProduct->feature_img;
                $d = url('/').'/storage';
                $img = ltrim($n,$d);
                $img = '/public/pro'.$img; // idk why this 'pro' was trimmed earlier
                // dd($img);
                Storage::delete($img);
            }
            // dd($randomFileName);
            $cp->storeAs('product/fi',$randomFileName , 'public');
            $newProduct->feature_img = url('/').'/storage'.'/product/fi/'.$randomFileName;
            $newProduct->save();

            return response()->json([
                'success' => true,
                'image' => $newProduct->feature_img,
            ]);
            }else{
                return response()->json([
                    'hasError' => true,
                    'errorMessage' => 'The file is not supported. Please select an Image file.',
                ]);
            }
        }
        else{
            return response()->json([
                'hasError' => true,
                'errorMessage' => 'Image not Found',
            ]);
        }
    }

    public function productMoreImages(Agent $agent, Request $request)
    {
        dd($request->all());
        if ($request->moreImages) {
        foreach ($request->moreImages as $f)
        {

                $newProduct = $this->create($agent);
                $cp =  $f;
                $mime = $cp->getClientMimeType();
                if ($mime == "image/webp" || $mime == "image/jpeg" || $mime == "image/png" ) {

                $extension = strtolower($cp->getClientOriginalExtension());
                $size =$cp->getSize();

                $randomFileName = $newProduct->id.'_media_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

                $cp->storeAs('product/media',$randomFileName , 'public');

                $file = new EcommerceProductMedia;
                $file->ecommerce_product_id = $newProduct->id;
                $file->addedby_id = auth()->user()->id;
                $file->file_name = $randomFileName;
                $file->file_link = url('/').'/storage'.'/product/media/'.$randomFileName;
                $file->ext = $extension;
                $file->mime = $mime;
                $file->size = $size;
                $file->type = 'image';
                $file->save();
            }
        }
    }
}
    public function getCategories(Agent $agent)
    {
        $categories = EcommerceCategory::where('active', true)->get()->toTree();
        $newProduct = $this->create($agent);
        $result = [
            'categories' => $categories,
        ];
        return response()->json($result, 200);
    }
    public function getProductCategories(Agent $agent, EcommerceCategory $category)
    {
        $newProduct = $this->create($agent);
        $categories = $newProduct->categoryRelations;
        return response()->json($categories, 200);
    }
    public function productHasCategories(Agent $agent, EcommerceCategory $category)
    {
        $newProduct = $this->create($agent);
        $hasCategory = $newProduct->categoryRelations()->exists();
        return $hasCategory;
    }
    public function productCategorySave(Agent $agent, Request $request)
    {
        $newProduct = $this->create($agent);
        if (isset($request->category) && !empty($request->category)) {
            $prodCat = new EcommerceCatProduct;
            $prodCat->product_id = $newProduct->id;
            $prodCat->category_id = $request->category;
            $prodCat->category_string = $request->categoy_string;
            $prodCat->addedby_id = auth()->user()->id;
            $prodCat->save();
        }
        $newProduct->b_to_b = $request->b2b;
        $newProduct->b_to_c = $request->b2c;
        $newProduct->min_order_quantity = $request->moq;
        $newProduct->purchase_price = $request->purchase_price;
        $newProduct->sale_price = $request->sale_price;
        $newProduct->compare_price = $request->compare_price ?? 0;
        $newProduct->save();

        if ($request->minUnit && $request->unitPurchasePrice && $request->unitSalePrice) {
            $price =  new EcommerceProductPrice;
            $price->product_id = $newProduct->id;
            $price->min_unit = $request->minUnit;
            $price->purchase_price = $request->unitPurchasePrice;
            $price->sale_price = $request->unitSalePrice;
            $price->save();
        }
        if (isset($request->priceList) && count($request->priceList) > 0) {
            foreach ($request->priceList as $priceList) {
                $price =  new EcommerceProductPrice;
                $price->product_id = $newProduct->id;
                $price->min_unit = $priceList['unit'];
                $price->purchase_price = $priceList['purchase_price'];
                $price->sale_price = $priceList['sale_price'];
                $price->save();
            }
        }
        return response()->json([
            'success' => true,
        ], 200);
    }
    public function productCategoryRemove(Agent $agent, Request $request)
    {
        $newProduct = $this->create($agent);
        $category = $newProduct->categoryRelations()->where('id',$request->catRelId)->first();
        if ($category) {
            $category->delete();
        }
        return true;
    }

    public function productOwnerSearch(Agent $agent, Request $request)
    {
        $q  = $request->q;
        $users = User::where(function($query) use ($q){

            $query->where('email', 'like', '%'.$q.'%');
            $query->orWhere('mobile', 'like', '%'.$q.'%');

        })
        ->where('active', true)

        // ->orWhere('username', 'like', '%'.$request->q.'%')
        // ->orWhere('name', 'like', '%'.$request->q.'%')
        // ->orWhere('mobile', 'like', '%'.$request->q.'%')
        ->select(['id','email','mobile'])->take(30)->get();
        return response()->json($users, 200);
    }

    public function submitProduct(Agent $agent, Request $request)
    {
        // dd($request->all());
        $newProduct = $this->create($agent);

        $newProduct->user_id = $request->user_id;
        $newProduct->source_id = $request->source_id;
        $newProduct->status = 'pending';
        $newProduct->save();

        return response()->json($newProduct, 200);
    }

    public function getPublishedProducts(Request $request,Agent $agent, EcommerceSource $source)
    {

        $categories = $source->commissions()->pluck('category_id')->toArray();

        $products = EcommerceProduct::where('status', 'published')->whereIn('category_id', $categories)->orderBy('cat_title')->orderBy('name')->paginate(20);
        foreach ($products as $product){
           $product->shopPrice = $product->shopAmount($source->id);
        }

        return response()->json($products, 200);
    }
    function deleteOrderItem(Agent $agent,Request $request,EcommerceOrder $order){
        $orderItem= $order->items()->where('id',$request->item)->first();
        $order->decrement('total_price',$orderItem->total_price);
        $order->decrement('total_collection_amount',$orderItem->collection_amount);
        $order->items()->where('id',$request->item)->delete();
    return response()->json(['success'=>true],200);
    }
    function UpdateOrderItem(Agent $agent,Request $request,EcommerceOrder $order,EcommerceOrderItem $orderItem){
        $qty= $request->qty;
       $source= EcommerceSource::find($request->source);
       $orderItem= $order->items()->where('id',$request->item)->first();
       $product= EcommerceProduct::find($orderItem->product_id);
//       return $product;

        if ($order->order_status != 'pending') {
            return response()->json(['success'=>false],200);
        }
       $unitPrice = $product->priceByQuantity($qty);
       $orderItem->total_quantity= $qty;
       $orderItem->total_price = $unitPrice*$qty;

       $shop_commission = $source->commissionByProduct($orderItem->product_id);
       $shop_payment = round($orderItem->total_price - (($orderItem->total_price/100)*$shop_commission), 2);
       $orderItem->collection_amount= $shop_payment;
        if ($product->pice) {
            if ($product->pice > $qty) {
                $orderItem->bonus = 0;
            }
            $bonus= ($product->bonus * $qty) / $product->pice ;
            $orderItem->bonus = (int) $bonus;
        }else{
            $orderItem->bonus = 0;
        }
       $orderItem->save();


       $totalCollection= $order->items()->sum('collection_amount');
       $totalPrice= $order->items()->sum('total_price');
       $order->total_price = $totalPrice;
       $order->total_collection_amount = $totalCollection;
       $order->save();

        return response()->json(['success'=>true],200);

    }

    public function getProductAmountByShop(Agent $agent, EcommerceSource $source, EcommerceProduct $product)
    {
        $data = $product->shopAmount($source->id);
        $com= $product->shopCommissionPercent($source->id);

        return response()->json(['data'=>$data,'commission'=>$com], 200);
    }

    public function getSalesList(Agent $agent, SalesList $salesList)
    {
        $data = $salesList->where('addedby_id', null)->orWhere('addedby_id', auth()->user()->id)->get();
        return response()->json($data, 200);
    }
    public function getSalesListProducts(Agent $agent, SalesList $list)
    {
        $data = $list->products()->where('status', 'published')->paginate(20);
        return response()->json($data, 200);
    }
    public function searchProductList(Agent $agent, EcommerceSource $source, EcommerceProduct $product, Request $request)
    {
        if ($request->query) {
            $categories = $source->commissions()->pluck('category_id')->toArray();
            $keyword = $request->all();
            $data = $product->where('status', 'published')
            ->whereIn('category_id', $categories)
            ->where(function($query) use ($keyword){
                // $query->whereRaw("UPPER('name->en') LIKE '%". strtoupper($keyword['query'])."%'")
                    // ->orWhereRaw('excerpt', 'LIKE', "%{$keyword['query']}%")
                    // ->orWhereRaw('description', 'LIKE', "%{$keyword['query']}%")

                $query->where('id', 'LIKE' , "%{$keyword['query']}%")
                    ->orwhere('name', 'LIKE' , "%{$keyword['query']}%")
                    ->orWhere('excerpt', 'LIKE', "%{$keyword['query']}%")
                    ->orWhere('description', 'LIKE', "%{$keyword['query']}%")

                    ;})

            ->paginate(10);
            return response()->json($data, 200);
        }
        return response()->json('error', 209);
    }
}
