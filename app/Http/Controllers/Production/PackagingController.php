<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Raw;
use App\Models\Sample;
use Illuminate\Http\Request;
use App\Models\RawStock;
use App\Models\SampleItem;
use Auth;
use Carbon\Carbon;

class PackagingController extends Controller
{
    public function packaging(Request $request)
    {
        if ($request->pack_id) {
            $packMaterials = Raw::where('type', 'pack')->where('id','!=',$request->pack_id)->orderBy('name')->get();
        }else{
            $packMaterials = Raw::where('type', 'pack')->orderBy('name')->get();
        }

        return view('production.packaging.appendPack', compact('packMaterials'))->render();
    }

    public function getPrice(Request $request)
    {
        $qty= $request->quantity;
        $pack = Raw::where('id',$request->pack_id)->first();

        $html = view('production.packaging.ajax.stockBatches',compact('pack','qty'))->render();


        return response()->json([
            'html' =>$html,
            'pack_id'=> $pack->id
        ]);

    }
}
