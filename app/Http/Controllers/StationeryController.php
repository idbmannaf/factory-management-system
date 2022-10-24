<?php

namespace App\Http\Controllers;

use App\Models\Stationery;
use Illuminate\Http\Request;
use Auth;

class StationeryController extends Controller
{
   public function stationeries(){
       menuSubmenu('stationeries','allStationeries');
       $stationeries = Stationery::where('active',true)->latest()->paginate(50);
       return view('stationeries.index',compact('stationeries'));
   }
   public function storeStationeries(Request $request){
       $request->validate([
           'name'=>'required',
           'unit'=>'required',
           'unit_value'=>'required',
           'active'=>'nullable',
       ]);
       $stationery = new Stationery;
       $stationery->name = $request->name;
       $stationery->unit = $request->unit;
       $stationery->unit_value = $request->unit_value;
       $stationery->active = $request->active ? 1 : 0;
       $stationery->addedBy_id = Auth::id();
       $stationery->save();
       return redirect()->back()->with('success','Stationery Item Successfully Added');
   }
   public function updateStationery(Stationery $stationery, Request $request){
       $request->validate([
           'name'=>'required',
           'unit'=>'required',
           'unit_value'=>'required',
           'active'=>'nullable',
       ]);
       $stationery->name = $request->name;
       $stationery->unit = $request->unit;
       $stationery->unit_value = $request->unit_value;
       $stationery->active = $request->active ? 1 : 0;
       $stationery->editedBy_id = Auth::id();
       $stationery->save();
       return redirect()->back()->with('success','Stationery Item Successfully Updated');
   }
   public function deleteStationery(Stationery $stationery){
       $stationery->delete();
       return redirect()->back()->with('success','Stationery Item Successfully Deleted');

   }
}
