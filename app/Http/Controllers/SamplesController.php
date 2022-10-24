<?php

namespace App\Http\Controllers;


use App\Models\Old\SamplesItem;
use App\Models\Raw;
use App\Models\Sample;
use App\Models\SampleItem;
use Auth;
use Illuminate\Http\Request;
use DB;

class SamplesController extends Controller
{
    public $dhpl;
    public function __construct()
    {
        $this->dhpl = DB::connection('dhpl');
    }
    public function allSamples()
    {
        menuSubmenu('samples','allSamples');
        $samples = Sample::with('sample_items')->latest()->paginate(40);
        return view('admin.samples.allSamples', compact('samples'));
    }

    public function createSample(Request $request)
    {
        $raws = Raw::orderBy('name')->where('type','raw')->get();
        $products= $this->dhpl->table('ecommerce_products')->orderBy('name')->paginate(30);
        return view('admin.samples.createSamples', compact('raws','products'));
    }

    public function createSamplesAjax(Request $request)
    {
        $raws = Raw::orderBy('name')->where('type','raw')->get();
        $html = view('admin.samples.ajax.sampleAjax', compact('raws'))->render();
        return $html;
    }
    public function checkRawBatch(Request $request)
    {
        $raw = Raw::where('id',$request->raw)->first();

        return view('admin.samples.ajax.rawBatch', compact('raw'))->render();

    }

    public function storeSample(Request $request)
    {
        $request->validate([
            'dhpl_product_id'=>'required',
            'sample_unit'=>'required',
        ]);
        $product = $this->dhpl->table('ecommerce_products')->find($request->dhpl_product_id);
        $sample = new Sample;
        $sample->unit_value = $request->unit_value;
        $sample->unit = $request->sample_unit;
        $sample->dhpl_product_id = $product->id;
        $sample->dhpl_cat_id = $product->category_id;
        $sample->name = json_decode($product->name)->en;
        $sample->details = $request->details;
        $sample->active = $request->active ? 1 : 0;
        $sample->addedBy_id = Auth::id();
        $sample->save();

        $raws = $request->raw_id;
        $unit_value = $request->unit_item_value;
        $unit = $request->unit;

        for ($i = 0; $i < count($raws); $i++) {
            $sample_item = new SampleItem;
            $sample_item->sample_id = $sample->id;
            $sample_item->raw_id = $raws[$i];
            $sample_item->category_id = Raw::find($raws[$i])->category_id;
            $sample_item->unit = $unit[$i];
            $sample_item->unit_value = $unit_value[$i];
            $sample_item->addedBy_id = Auth::id();
            $sample_item->save();
        }
        return redirect()->back()->with('success', "Sample Added Successfully");
    }

    public function editSample(Sample $sample)
    {
        $raws = Raw::orderBy('name')->where('type','raw')->get();
        return view('admin.samples.editSamples', compact('raws', 'sample'));
    }

    public function updateSample(Sample $sample, Request $request)
    {

        $product = $this->dhpl->table('ecommerce_products')->find($request->dhpl_product_id);
        $sample->dhpl_product_id = $product->id;
        $sample->dhpl_cat_id = $product->category_id;
        $sample->name = json_decode($product->name)->en;
        $sample->unit_value = $request->unit_value;
        $sample->unit = $request->sample_unit;
        $sample->details = $request->details;
        $sample->active = $request->active ? 1 : 0;
        $sample->editedBy_id = Auth::id();
        $sample->save();

        $sample->sample_items()->delete();

        $raws = $request->raw_id;
        $unit_value = $request->unit_item_value;
        $unit = $request->unit;
        for ($i = 0; $i < count($raws); $i++) {
            $sample_item = new SampleItem;
            $sample_item->sample_id = $sample->id;
            $sample_item->raw_id = $raws[$i];
            $sample_item->category_id = Raw::find($raws[$i])->category_id;
            $sample_item->unit = $unit[$i] ?? strtolower(Raw::find($raws[$i])->unit);
            $sample_item->unit_value = $unit_value[$i];
            $sample_item->addedBy_id = Auth::id();
            $sample_item->save();
        }
        return redirect()->back()->with('success', 'Samples Successfully Updated');
    }

    public function viewSample(Request $request)
    {
        $sample = Sample::with('sample_items')->find($request->sample);

        return view('admin.samples.viewSamples',compact('sample'));
    }
    public function deleteSample(Sample $sample){
        $sample->sample_items()->delete();
        $sample->delete();
        return redirect()->back()->with('success','Sample Successfully Deleted');
    }

    public function checkRawUnit(Request $request)
    {
        $type = $request->type;
        if ($type == 'raw') {
            $raw = Raw::find($request->raw);
            return response()->json([
                'unit'=>strtolower($raw->unit)
            ]);
        }
        if ($type == 'product') {
            $product = $this->dhpl->table('ecommerce_products')->find($request->product_id);
            return response()->json([
                'unit'=>strtolower($product->unit)
            ]);
        }
        if ($type == 'sample') {
            $sample = Sample::find($request->sample_id);
            return response()->json([
                'unit'=>strtolower($sample->unit)
            ]);
        }

    }
}
