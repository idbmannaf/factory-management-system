<?php

namespace App\Http\Controllers\Web\Admin\Ecommerce;

use DB;
use Auth;
use Cache;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Model\Post;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EcommerceShopCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\Ecommerce\EcommerceCategory;

class AdminProductCategoryController extends Controller
{
    public function productCategories()
    {
        menuSubmenu('ecommerce','productCategories');

        $categories=EcommerceCategory::orderBy('id','desc')->get(['id', 'name->en as text','parent_id as parent', DB::raw('IFNULL(parent_id,"#") as parent')]);

        return view('admin.ecommerce.categories.productCategories',[
            'categories' => $categories
        ]);
    }

    public function updateCategoriesByJsTree(Request $request)
    {
        $type = $request->type;
        if($type == 'create_node')
        {
            $pId = $request->parent_id == '#' ? null : $request->parent_id;
            $cat = new EcommerceCategory;
            $cat->parent_id = $pId;

            $cat->position = $request->position ?: 0;
            $cat->active = true;
            $cat->featured = false;

            $cat->name = $request->text ?: 'New Category';
            $cat->save();

            if($request->ajax())
            {
                return Response()->json([

                'success' => true,
                'data' => $cat

                ]);
            }
        }

        if($type == 'rename_node')
        {

            $cat = EcommerceCategory::find($request->id);
            $cat->name = $request->text;
            $cat->save();

            if($request->ajax())
            {
                return Response()->json([

                'success' => true,
                // 'data' => $cat

                ]);
            }
        }

        if($type == 'delete_node')
        {

            //image delete
            //media edit
            //product detach
            $cat = EcommerceCategory::find($request->id);
            EcommerceCategory::where('parent_id', $cat->id)->update(['parent_id' => null]);
            $cat->delete();


            if($request->ajax())
            {
                return Response()->json([

                'success' => true,

                ]);
            }
        }

        if($type == 'move_node')
        {
            $cat = EcommerceCategory::find($request->id);
            $cat->parent_id = $request->parent_id == '#' ? null : $request->parent_id;

            $cat->position = $request->position;
            $cat->name = $request->text;
            $cat->save();

            if($request->ajax())
            {
                return Response()->json([

                'success' => true,

                ]);
            }
        }

        if($type == 'copy_node')
        {

            $cat = new EcommerceCategory;
            $cat->parent_id = $request->parent_id == '#' ? null : $request->parent_id;
            $cat->position = $request->position;


            $cat->save();

            if($request->ajax())
            {
                return Response()->json([

                'success' => true,
                'data' => $cat

                ]);
            }
        }

        if($type == 'select_node')
        {

            $cat = EcommerceCategory::find($request->id);

            if($request->ajax())
            {
                return Response()->json([

                'success' => true,
                'page' => view('admin.ecommerce.categories.includes.forms.categorySingleForm',['cat'=>$cat])->render()

                ]);
            }
        }

         return back();
    }

    public function categoryUpdatePost(EcommerceCategory $cat, Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(),
        [
            'name'=> 'required|min:2|max:100',
            'sr_commission'=> 'nullable|numeric',
            'shop_commission'=> 'nullable|numeric',
        ]);

        if($validation->fails())
        {
            if($request->ajax()){
                return Response()->json([
                    'success' => false,
                    'sessionError' => 'something went wrong',
                    'errors' => $validation->errors()->toArray()
                ]);
            }
            return back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'Something Went Wrong!');


        }

        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->active = $request->active ? 1 : 0;
        $cat->sr_commission = $request->sr_commission ?? 10;
        $cat->shop_commission = $request->shop_commission ?? 20;
        $cat->featured = $request->featured ? 1 : 0;
        $cat->editedby_id = Auth::id();
        $cat->save();
        $cat->products()->update([
            'cat_title'=> $cat->name
        ]);

        if($cp = $request->banner)
        {
            $f = 'media/category/banner/'.$cat->banner_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $cat->media()->where('collection_name', 'category_banner')->delete();
            }

            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();

             $extension = strtolower($cp->getClientOriginalExtension());
             $originalName = strtolower($cp->getClientOriginalName());
             $randomFileName = $cat->id.'_banner_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('media/category/banner/'.$randomFileName, File::get($cp));

            $file_new_url = 'storage/media/category/banner/'.$randomFileName;
            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'category_banner';
            // $media->disk  = 'public';
            $cat->media()->save($media);

            $cat->banner_name = $randomFileName;

        }

        if($cp = $request->image)
        {
            $f = 'media/category/image/'.$cat->img_name;
            if(Storage::disk('public')->exists($f))
            {
                Storage::disk('public')->delete($f);
                $cat->media()->where('collection_name', 'category_image')->delete();
            }
            list($width,$height) = getimagesize($cp);
            $mime = $cp->getClientOriginalExtension();
            $size =$cp->getSize();

            $extension = strtolower($cp->getClientOriginalExtension());
            $originalName = strtolower($cp->getClientOriginalName());
            $randomFileName = $cat->id.'_img_'.date('Y_m_d_his').'_'.rand(10000000,99999999).'.'.$extension;

            Storage::disk('public')->put('media/category/image/'.$randomFileName, File::get($cp));

            $file_new_url = 'storage/media/category/image/'.$randomFileName;

            $media = new Media;
            $media->file_name  = $randomFileName;
            $media->file_original_name  = $originalName;
            $media->file_mime  = $mime;
            $media->file_ext  = $extension;
            $media->file_size  = $size;
            $media->file_type  = 'image';
            $media->width  = $width;
            $media->height  = $height;
            $media->file_url  = $file_new_url;
            $media->addedby_id  = Auth::id();
            $media->editedby_id  = null;
            $media->collection_name  = 'category_image';
            // $media->disk  = 'public';
            $cat->media()->save($media);

            $cat->img_name = $randomFileName;

        }

        $cat->save();

        Cache::flush();

        if($request->ajax())
        {
            return Response()->json([
                'success' => true,
                'page'=> View('admin.ecommerce.categories.includes.forms.categorySingleForm',[
                    'cat' => $cat,
                ])->render()
            ]);
        }


        return back();
    }

}
