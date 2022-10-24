<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        if ($request->type == 'raw') {
            menuSubmenu('category','allRawCategory');
            $categories = Category::where('type','raw')->latest()->paginate(20);
            return view('admin.category.rawCategories',compact('categories'));
        }else{
            menuSubmenu('category','allPackCategory');
            $categories = Category::where('type','pack')->latest()->paginate(20);
            return view('admin.category.packCategories',compact('categories'));
        }

    }
    public function storeCategories(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'active'=>'nullable',
        ]);
        $category = new Category;
        $category->name = $request->name;
        $category->type = $request->type;
        $category->active = $request->active ? 1 : 0;
        $category->user_id = Auth::id();
        $category->addedBy_id = Auth::id();
        $category->save();
        return redirect()->back()->with('success','Category Successfully Added');

    }
    public function updateCategories(Category $category, Request $request)
    {
        $request->validate([
            'name'=>'required',
            'cat_type'=>'required',
            'active'=>'nullable',
        ]);
        $category->name = $request->name;
        $category->type = $request->cat_type;
        $category->active = $request->active ? 1 : 0;
        $category->editedBy_id = Auth::id();
        $category->save();
        return redirect()->back()->with('success','Category Successfully Updated');
    }
    public function deleteCategories(Category $category){
        if($category->HasRaws() || $category->hasSubcategory()){
            return redirect()->back()->with('warning','You are not able to Delete This Category');
        }
        $category->delete();
        return redirect()->back()->with('success','Category Successfully Deleted');
    }
    public function subcategories(){
        menuSubmenu('category','allSbCategories');
        $sub_categories =SubCategory::latest()->paginate(50);
        $categories= Category::where('active',true)->orderBy('name')->latest()->get();
        return view('admin.category.subCategory.index',compact('sub_categories','categories'));
    }
    public function storeSubCategories(Request $request){
        $request->validate([
            'category_id'=>'required',
            'name'=>'required',
            'active'=>'nullable',
        ]);
        $category = Category::find($request->category_id);
        $subcategory = new SubCategory;
        $subcategory->user_id = Auth::id();
        $subcategory->category_id = $category->id;
        $subcategory->name = $request->name;
        $subcategory->active = $request->active ? 1 : 0;
        $subcategory->type = $category->type;
        $subcategory->addedBy_id = Auth::id();
        $subcategory->save();
        return redirect()->back()->with('success','Category Type Successfully added');
    }
    public function updateSubCategories(Request $request){
        $request->validate([
            'category_id'=>'required',
            'name'=>'required',
        ]);

        $category = Category::find($request->category_id);
        $subCategory = SubCategory::find($request->subcat);
        $subCategory->category_id = $category->id;
        $subCategory->name = $request->name;
        $subCategory->active = $request->active ? 1 : 0;
        $subCategory->type = $category->type;
        $subCategory->editedBy_id = Auth::id();
        $subCategory->save();
        return redirect()->back()->with('success','Category Type Successfully Updated');

    }
    public function deleteSubCategories(Request $request){
        $subCategory = SubCategory::find($request->subcat);
        $subCategory->delete();
        return redirect()->back()->with('success','Category Type Successfully Deleted');

    }


}
