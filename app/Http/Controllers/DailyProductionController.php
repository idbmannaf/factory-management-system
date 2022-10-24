<?php

namespace App\Http\Controllers;

use App\Models\DailyProduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class DailyProductionController extends Controller
{
    public $dhpl;
    public function __construct()
    {
        $this->dhpl = DB::connection('dhpl');
    }
    public function dailyProduction(Request $request){

        $products= $this->dhpl->table('ecommerce_products')->orderBy('name')->paginate(30);
        $type = $request->type;
        menuSubmenu('dailyProductions',$type.'Productions');
       if ($type == 'all') {
        $dailyProduction= DailyProduction::latest()->paginate(20);
       }elseif ($type == 'rejected') {
        $dailyProduction= DailyProduction::latest()->where('status','rejected')->paginate(20);
       }elseif ($type == 'approved') {
        $dailyProduction= DailyProduction::latest()->where('status','approved')->paginate(20);
       }elseif($type == 'pending') {
        $dailyProduction= DailyProduction::latest()->where('status','pending')->paginate(20);
       }
       else{
           return back();
       }
       return view('admin.dailyProduction.index',compact('products','dailyProduction','type'));

    //     menuSubmenu('dailyProductions','allDailyProductions');
    //     $type = $request->type;
    //    $products= $this->dhpl->table('ecommerce_products')->orderBy('name')->paginate(30);
    //     $dailyProduction= DailyProduction::latest()->paginate(20);

    //     if ($request->route()->getPrefix() == '/production'){
    //         return view('production.dailyProduction.index',compact('products','dailyProduction'));
    //     }elseif ($request->route()->getPrefix() == '/admin'){
    //         if ($type == 'all') {
    //             $dailyProduction= DailyProduction::latest()->paginate(20);
    //            }elseif ($type == 'rejected') {
    //             $dailyProduction= DailyProduction::latest()->where('status','rejected')->paginate(20);
    //            }elseif ($type == 'approved') {
    //             $dailyProduction= DailyProduction::latest()->where('status','approved')->paginate(20);
    //            }elseif($type == 'pending') {
    //             $dailyProduction= DailyProduction::latest()->where('status','pending')->paginate(20);
    //            }
    //            else{
    //                return back();
    //            }
    //         return view('admin.dailyProduction.index',compact('products','dailyProduction'));
    //     }elseif ($request->route()->getPrefix() == '/accounts'){
    //         return view('accounts.dailyProduction.index',compact('products','dailyProduction'));
    //     }else{
    //         return  back();
    //     }

    }
    public function dailyProductionPost(Request $request){
        $request->validate([
            'product'=>'required',
            'quantity'=>'required',
            'pack'=>'required',
        ]);
        $product = $this->dhpl->table('ecommerce_products')->where('id',$request->product)->first();
        $category= $this->dhpl->table('ecommerce_categories')->where('id',$product->category_id)->first();
        $daily_production = new DailyProduction;
        $daily_production->product_id = $product->id;
        $daily_production->category_id = $product->category_id;
        $daily_production->category_name = json_decode($category->name)->en;;
        $daily_production->product_name = json_decode($product->name)->en;
        $daily_production->quantity = $request->quantity;
        $daily_production->pack = $request->pack;
        $daily_production->unit = $product->unit;
        $daily_production->unit_value = $product->unit_value;
        $daily_production->type = $product->type;
        $daily_production->type_value = $product->type_value;
        $daily_production->addedBy_id = Auth::id();
        $daily_production->save();
        return redirect()->back()->with('success', 'Daily Production Added Successfully');
    }

    public function editDailyProduction (Request $request){
        $products= $this->dhpl->table('ecommerce_products')->orderBy('name')->get();
        $production = DailyProduction::find($request->production);
             if ($request->route()->getPrefix() == '/production'){
                 return view('production.dailyProduction.edit',compact('products','production'));
             }elseif ($request->route()->getPrefix() == '/admin'){
                 return view('admin.dailyProduction.edit',compact('products','production'));
             }elseif ($request->route()->getPrefix() == '/accounts'){
                 return view('accounts.dailyProduction.edit',compact('products','production'));
             }elseif ($request->route()->getPrefix() == '/factory'){
                return view('factoryManager.dailyProduction.edit',compact('products','production'));
            }else{
                 return  back();
             }

    }
    public function updateDailyProduction(Request $request){
        $request->validate([
            'product'=>'required',
            'quantity'=>'required',
            'pack'=>'required',
        ]);

        $product = $this->dhpl->table('ecommerce_products')->where('id',$request->product)->first();
        $category= $this->dhpl->table('ecommerce_categories')->where('id',$product->category_id)->first();
        $production = DailyProduction::find($request->production);
        $production->product_id = $product->id;
        $production->category_id = $product->category_id;
        $production->category_name = json_decode($category->name)->en;
        $production->product_name = json_decode($product->name)->en;
        $production->quantity = $request->quantity;
        $production->pack = $request->pack;
        $production->unit = $product->unit;
        $production->unit_value = $product->unit_value;
        $production->type = $product->type;
        $production->type_value = $product->type_value;
        $production->editedBy_id = Auth::id();
        $production->save();
        return redirect()->back()->with('success', 'Daily Production updated Successfully');
    }

    public function deleteDailyProduction(Request $request){
        $production = DailyProduction::find($request->production);
        $production->delete();
        return redirect()->back()->with('success', 'Daily Production Deleted Successfully');

    }
    public function updateDailyProductionStatus(Request $request){
        $production = DailyProduction::find($request->production);
        $production->status= $request->status;
        $production->save();
        return redirect()->back()->with('success', 'Daily Production status Updated Successfully Successfully');

    }
}
