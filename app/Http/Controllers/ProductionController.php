<?php

namespace App\Http\Controllers;

use App\Models\AfterProccessProduct;
use App\Models\Category;
use App\Models\DailyProduction;
use App\Models\PackReqTemp;
use App\Models\Product;
use App\Models\ProductMaterial;
use App\Models\Raw;
use App\Models\RawStock;
use App\Models\Requisition;
use App\Models\RequisitionItem;
use App\Models\Sample;
use App\Models\SampleItem;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use DB;

class ProductionController extends Controller
{
    public $dhpl;
    public function __construct()
    {
        $this->dhpl = DB::connection('dhpl');
    }
    public function dashboard(Request $request)
    {

        menuSubmenu('dashboard', 'dashboard');
        return view('production.dashboard.productionDashboard');
    }

    function stockedMaterials(Request $request)
    {
        menuSubmenu('stockedMaterials', 'all');
        $type = $request->type;
        if ($request->type == 'raw') {
            menuSubmenu('stockedMaterials', 'rawStockedMaterials');
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->where('type', 'raw')->paginate(30);
        } elseif ($request->type == 'pack') {
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->where('type', 'pack')->paginate(30);
        } elseif ($request->type == 'stationery') {
            menuSubmenu('stockedMaterials', 'stationeryStockedMaterials');
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->with('requisition', 'raw')->where('type', 'stationery')->paginate(30);
        } else {
            $stockedMaterials = RawStock::orderBy('id', 'DESC')->paginate(30);
        }
        return view('production.stockedMaterials', compact('stockedMaterials', 'type'));
    }

    public function requisitions(Request $request)
    {
        $type = $request->type;
        menuSubmenu('requisitions', $type);
        if ($type == 'all') {

            $requisitions = Requisition::orderByRaw("FIELD(status,'approved','stocked','pending','collected')")->latest()->where('status', '!=', 'temp')->paginate(20);
        } elseif ($type == 'pending') {
            $requisitions = Requisition::where('status', 'pending')->where('status', '!=', 'temp')->latest()
                ->latest()->paginate(20);
        } elseif ($type == 'approved') {
            $requisitions = Requisition::where('status', 'approved')->where('status', '!=', 'temp')->latest()
                ->latest()->paginate(20);
        } elseif ($type == 'pending_purchase') {
            $requisitions = Requisition::where('status', 'pending_purchase')->where('status', '!=', 'temp')->latest()
                ->latest()->paginate(50);
        } elseif ($type == 'approved_purchase') {
            $requisitions = Requisition::where('status', 'approved_purchase')->where('status', '!=', 'temp')->latest()
                ->latest()->paginate(50);
        } elseif ($type == 'purchase') {
            $requisitions = Requisition::where('status', 'purchase')->where('status', '!=', 'temp')->latest()
                ->latest()->paginate(50);
        } elseif ($type == 'collected') {
            $requisitions = Requisition::where('status', 'collected')->where('status', '!=', 'temp')->latest()
                ->latest()->paginate(20);
        } elseif ($type == 'stocked') {
            $requisitions = Requisition::where('status', 'stocked')->where('status', '!=', 'temp')->latest()
                ->latest()->paginate(20);
        } else {
            return back();
        }
        return view('production.requisition.requisitionAll', compact('requisitions', 'type'));
    }


    public function newRequisition(Request $request)
    {
        menuSubmenu('requisitions', 'addRawRequisition');
        $requisition = Requisition::where('status', 'temp')->where('user_id', Auth::id())->where('type', 'raw')->first();
        if (!$requisition) {
            $requisition = new Requisition;
            $requisition->user_id = Auth::id();
            $requisition->addedBy_id = Auth::id();
            $requisition->status = 'temp';
            $requisition->type = 'raw';
            $requisition->save();
        }

        $rawMaterials = Raw::where('type', 'raw')->orderBy('name')->get();
        $packMaterials = Raw::where('type', 'pack')->orderBy('name')->get();
        $suppliers = Supplier::where('active', true)->get();
        return view('production.requisition.addNewRawRequisition', compact('packMaterials', 'rawMaterials', 'suppliers', 'requisition'));
    }
    public function stationaryRequisition(Request $request)
    {
        menuSubmenu('requisitions', 'addNewStationaryRequisition');
        $requisition = Requisition::where('status', 'temp')->where('user_id', Auth::id())->where('type', 'stationery')->first();
        if (!$requisition) {
            $requisition = new Requisition;
            $requisition->user_id = Auth::id();
            $requisition->addedBy_id = Auth::id();
            $requisition->status = 'temp';
            $requisition->type = 'stationery';
            $requisition->save();
        }

        $rawMaterials = Raw::where('type', 'raw')->orderBy('name')->get();
        $packMaterials = Raw::where('type', 'pack')->orderBy('name')->get();
        $suppliers = Supplier::where('active', true)->get();
        return view('production.requisition.addNewStationaryRequisition', compact('packMaterials', 'rawMaterials', 'suppliers', 'requisition'));
    }


    public function materialsAjax(Request $request)
    {
        $rawMaterials = Raw::where('type', 'raw')->orderBy('name')->get();
        $packMaterials = Raw::where('type', 'pack')->orderBy('name')->get();
        $stationeryMaterials = Raw::where('type', 'stationery')->orderBy('name')->get();
        $suppliers = Supplier::where('active', true)->get();

        if ($request->type == 'raw') {
            return view('production.ajax.appendRaw', compact('rawMaterials', 'suppliers'))->render();
        }
        if ($request->type == 'Pack') {
            return view('production.ajax.appendPack', compact('packMaterials', 'suppliers'))->render();
        }
        if ($request->type == 'stationery') {
            return view('production.ajax.appendStationery', compact('stationeryMaterials'))->render();
        }
    }

    public function viewRequisition(Request $request)
    {
        $requisition = Requisition::find($request->requisition);
        if (!$requisition) {
            return redirect()->back()->with('warning', 'Requisition Not Found');
        }
        return view('production.requisition.viewRequisition', compact("requisition"));
    }

    public function editRequisition(Request $request)
    {
        $requisition = Requisition::find($request->requisition);
        $rawMaterials = Raw::where('type', 'raw')->orderBy('name')->get();
        $packMaterials = Raw::where('type', 'pack')->orderBy('name')->get();
        $stationeryMaterials = Raw::where('type', 'stationery')->orderBy('name')->get();

        $suppliers = Supplier::where('active', true)->get();

        return view('production.requisition.editRequisition', compact("requisition", "suppliers", 'packMaterials', "rawMaterials", 'stationeryMaterials'));
    }

    public function updateRequisition(Request $request)
    {

        $requisition = Requisition::find($request->requisition);
        $requisition->date = $request->date ?? now();
        $requisition->pending_at = Carbon::now();
        $requisition->user_id = Auth::id();
        $requisition->editedBy_id = Auth::id();
        $requisition->status = 'pending';
        $requisition->save();

        if ($request->req_type == 'pack') {

            $quantities = $request->quantities;
            $raw_total_quantity = 0;
            if ($request->ids) {
                for ($i = 0; $i < count($request->ids); $i++) {
                    $requisition_item = RequisitionItem::find($request->ids[$i]);
                    $requisition_item->quantity = $quantities[$i];
                    $requisition_item->editedBy_id = Auth::id();
                    $requisition_item->save();
                    $raw_total_quantity += $requisition_item->quantity;
                }
            }

            $requisition->total_quantity = $raw_total_quantity;
            $requisition->save();
            return redirect()->back()->with('success', 'Requisition Successfully Updated');
        }


        $requisition->requisition_items()->delete();

        $raw_material = $request->raw_material;
        $raw_quantity = $request->raw_quantity;

        $raw_total_quantity = 0;
        if ($request->raw_material) {
            for ($i = 0; $i < count($request->raw_material); $i++) {
                $requisition_item = new RequisitionItem;
                $requisition_item->user_id = Auth::id();
                $requisition_item->requisition_id = $requisition->id;
                $requisition_item->quantity = $raw_quantity[$i];
                $requisition_item->raw_id = $raw_material[$i];
                $requisition_item->category_id = Raw::where('id', $raw_material[$i])->first()->category_id;
                $requisition_item->addedBy_id = Auth::id();
                $requisition_item->raw_type = 'raw';
                $requisition_item->save();
                $raw_total_quantity += $requisition_item->quantity;
            }
        }

        $pack_material = $request->pack_material;
        $pack_quantity = $request->pack_quantity;

        $total_pack_quantity = 0;
        if ($request->pack_material) {
            for ($i = 0; $i < count($request->pack_material); $i++) {
                $requisition_item = new RequisitionItem;
                $requisition_item->user_id = Auth::id();
                $requisition_item->requisition_id = $requisition->id;
                $requisition_item->quantity = $pack_quantity[$i];
                $requisition_item->raw_id = $pack_material[$i];
                $requisition_item->category_id = Raw::where('id', $pack_material[$i])->first()->category_id;
                $requisition_item->raw_type = 'pack';
                $requisition_item->addedBy_id = Auth::id();
                $requisition_item->save();
                $total_pack_quantity += $requisition_item->quantity;
            }
        }

        $stationery_material = $request->stationery_material;
        $stationery_quantity = $request->stationery_quantity;
        $total_stationery_quantity = 0;
        if ($request->stationery_material) {
            for ($i = 0; $i < count($request->stationery_material); $i++) {
                $requisition_item = new RequisitionItem;
                $requisition_item->user_id = Auth::id();
                $requisition_item->requisition_id = $requisition->id;
                $requisition_item->quantity = $stationery_quantity[$i];
                $requisition_item->raw_id = $stationery_material[$i];
                $requisition_item->raw_type = 'stationery';
                $requisition_item->addedBy_id = Auth::id();
                $requisition_item->save();
                $total_stationery_quantity += $requisition_item->quantity;
            }
        }
        $requisition->total_quantity = $raw_total_quantity + $total_pack_quantity + $total_stationery_quantity;
        $requisition->save();

        if ($request->type == "store") {
            return redirect()->back()->with('success', 'Requisition Successfully Updated');
        } else {
            return redirect()->back()->with('success', 'Requisition Successfully Updated');
        }
    }

    public function deleteRequisition(Request $request)
    {
        $requisition = Requisition::find($request->requisition);
        if ($requisition->status == 'pending') {
            $requisition->requisition_items()->delete();
            $requisition->delete();
            return redirect()->back()->with('success', 'Requisition Successfully Deleted');
        } else {
            return redirect()->back()->with('error', 'You are not able to  deleted this Requisition. Because, This Requisition is Not Pending');
        }
    }

    public function updateStatusRequisition(Request $request)
    {
        $requisition = Requisition::find($request->requisition);
        if ($request->status == 'collected') {

            $collected_qty = $request->collected_quantities;
            $ids = $request->ids;

            $collected_quantity = 0;
            $collect_wise_price = 0;
            for ($i = 0; $i < count($ids); $i++) {
                $reqItem = RequisitionItem::find($ids[$i]);
                $reqItem->collected_qty = $collected_qty[$reqItem->id];
                $reqItem->editedBy_id = Auth::id();
                $reqItem->save();
                $collected_quantity += $reqItem->collected_qty;
                $collect_wise_price += $reqItem->collected_qty *  $reqItem->final_price;
            }
            $requisition->collected_qty = $collected_quantity;
            $requisition->collect_wise_price = $collect_wise_price;
            $requisition->collected_at = Carbon::now();
            $requisition->status = 'collected';
            $requisition->save();
            return redirect()->back()->with('success', "Requisition Successfully Collected");
        }
    }

    public function allSamples()
    {
        menuSubmenu('samples', 'allSamples');
        $samples = Sample::latest()->paginate(50);
        return view('production.samples.allSamples', compact('samples'));
    }

    public function viewSample(Request $request)
    {
        $sample = Sample::with('sample_items')->where('id', $request->sample)->where('active', true)->first();
        return view('production.samples.viewSamples', compact('sample'));
    }

    public function materials(Request $request)
    {
        $type = $request->type;
        if ($type == 'raw') {
            menuSubmenu('Materials', 'RawMaterials');
            $rawMaterials = Raw::where('type', $type)->with('category')->orderBy('id', 'DESC')->paginate(30);
            $categories = Category::where('type', 'raw')->where('active', true)->orderBy('name')->get();
            return view('production.materials.rawMaterials', compact('rawMaterials', 'categories', 'type'));
        }
        if ($type == 'pack') {
            menuSubmenu('Materials', 'PackMaterials');
            $packaging = Raw::with('medicine')->where('type', $type)->with('category')->orderBy('category_id')->paginate(30);
            $categories = Category::where('type', 'pack')->where('active', true)->orderBy('name')->get();
            $medicine_types =$this->dhpl->table('ecommerce_categories')->get();
            return view('production.materials.packaging', compact('packaging', 'categories', 'type','medicine_types'));
        }
        if ($type == 'stationery') {
            menuSubmenu('Materials', 'stationeryMaterials');
            $stationeries = Raw::where('type', $type)->with('category')->orderBy('id', 'DESC')->paginate(30);
            return view('production.materials.stationeries', compact('stationeries', 'type'));
        }
    }

    public function createSample(Request $request)
    {
        $raws = Raw::orderBy('name')->where('type', 'raw')->where('active',true)->get();
        $products = $this->dhpl->table('ecommerce_products')->orderBy('name')->paginate(30);
        return view('production.samples.createSamples', compact('raws', 'products'));
    }
    public function editSample(Sample $sample)
    {
        $raws = Raw::orderBy('name')->where('type', 'raw')->get();
        return view('production.samples.editSamples', compact('raws', 'sample'));
    }

    public function readyProducts(Request $request)
    {
        menuSubmenu('readyProducts', 'readyProductsAll');
        $readyProducts = AfterProccessProduct::where('status', 'in_stocked')->groupBy('product_id')->groupBy('unit')->groupBy('unit_value')->latest()->paginate(30);
        return view('production.readyProducts', compact('readyProducts'));
    }

    public function dailyProduction(Request $request)
    {

        $products = $this->dhpl->table('ecommerce_products')->orderBy('name')->paginate(30);
        $type = $request->type;
        menuSubmenu('dailyProductions', $type . 'Productions');
        if ($type == 'all') {
            $dailyProduction = DailyProduction::latest()->paginate(20);
        } elseif ($type == 'rejected') {
            $dailyProduction = DailyProduction::latest()->where('status', 'rejected')->paginate(20);
        } elseif ($type == 'approved') {
            $dailyProduction = DailyProduction::latest()->where('status', 'approved')->paginate(20);
        } elseif ($type == 'pending') {
            $dailyProduction = DailyProduction::latest()->where('status', 'pending')->paginate(20);
        } else {
            return back();
        }
        return view('production.dailyProduction.index', compact('products', 'dailyProduction', 'type'));
    }

    public function packagingRequisition(Request $request)
    {
        menuSubmenu('requisitions', 'newRequisition');
        $requisition = Requisition::where('status', 'temp')->where('user_id', Auth::id())->where('type', 'pack')->first();
        if (!$requisition) {
            $requisition = new Requisition;
            $requisition->user_id = Auth::id();
            $requisition->addedBy_id = Auth::id();
            $requisition->status = 'temp';
            $requisition->type = 'pack';
            $requisition->save();
        }

        $tempPacks = PackReqTemp::where('user_id', Auth::id())->get();
        // dd($tempPacks);
        $packCategories = Category::where('type', 'pack')->orderBy('name')->get();

        return view('production.requisition.addNewPackRequisition', compact('packCategories', 'requisition', 'tempPacks'));
    }

    public function loadData(Request $request)
    {
        $type = $request->type;

        if ($type == 'medicine_type') {
            $medicine_types =$this->dhpl->table('ecommerce_categories')->get();
            return view('production.requisition.ajax.loadRawCats', compact('medicine_types'))->render();
        }
        if ($type == 'products') {
            $category = Category::find($request->pack_id);
            $medicine_type =$this->dhpl->table('ecommerce_categories')->find($request->medicine_type);
            $pack_materials = Raw::where('category_id', $category->id)->where('dhpl_cat_id',$medicine_type->id)->orderBy('name')->paginate(10);

            if ($request->paginate == 'yes') {
                $pack_materials = Raw::where('category_id', $category->id)->where('dhpl_cat_id',$medicine_type->id)->orderBy('name')->paginate(10);
               return view('production.requisition.ajax.loadProduct',[
                   'pack_materials'=>$pack_materials,
                   'q'=> '',
                   'type'=> '',
                   'pack_id'=> '',
                   'medicine_type'=> ''
               ])->render();
            }
            return view('production.requisition.ajax.loadProduct',[
                'pack_materials'=>$pack_materials,
                'q'=> '',
                'type'=> '',
                'pack_id'=> '',
                'medicine_type'=> ''


            ])->render();
        }
        if ($type == 'search') {

            $category = Category::find($request->pack_id);
            $medicine_type =$this->dhpl->table('ecommerce_categories')->find($request->medicine_type);
            $pack_materials = Raw::where('category_id', $category->id)
            ->where('dhpl_cat_id',$medicine_type->id)
            ->where('product_name','like','%'.$request->q."%")
            ->orderBy('name')->paginate(10);

            $q= $request->q;
            $type= $request->type;
            $pack_id= $request->pack_id;
            $medicine_type= $request->medicine_type;

            return view('production.requisition.ajax.loadProduct', compact('pack_materials','q','type','pack_id','medicine_type'))->render();
        }
    }

    public function selectProduct(Request $request)
    {
        $pack_material = Raw::find($request->pack_material);
        $temp = PackReqTemp::where('pack_cat_id', $pack_material->id)->where('requisition_id',$request->requisition_id)->where('user_id', Auth::id())->first();
        if (!$temp) {
            $temp = new PackReqTemp;
            $temp->pack_cat_id = $request->pack_cat_id;
            $temp->qty = 1;
            $temp->pack_id= $pack_material->id;
            $temp->requisition_id = $request->requisition_id;
            $temp->raw_cat_id = $request->raw_cat_id;
            $temp->dhpl_cat_id = $pack_material->dhpl_cat_id;
            $temp->product_id = $pack_material->product_id;
            $temp->product_name = $pack_material->product_name;
            $temp->unit = $pack_material->unit;
            $temp->unit_value = $pack_material->unit_value;
            $temp->user_id = Auth::id();
            $temp->save();
        }

        $tempPacks = PackReqTemp::where('user_id', Auth::id())->get();
        return response()->json([
            'success' => true,
            'view' => view('production.requisition.ajax.selectedItems', compact('tempPacks'))->render()
        ]);
    }
    public function unSelectProduct(Request $request)
    {
        $temp = PackReqTemp::where('pack_id',$request->pack_material)->where('user_id', Auth::id())->first();
        if ($temp) {
            $pack_id = $temp->pack_id;
            $temp->delete();

        }else{
            $pack_id = 0;
        }
        $tempPacks = PackReqTemp::where('user_id', Auth::id())->get();
        return response()->json([
            'success' => true,
            'pack_id'=>$pack_id,
            'view' => view('production.requisition.ajax.selectedItems', compact('tempPacks'))->render()
        ]);
    }
    public function updateQuanity(Request $request)
    {
        $tempItem = PackReqTemp::find($request->temp);
        $tempItem->qty = $request->quantity;
        $tempItem->save();
        $tempPacks = PackReqTemp::where('user_id', Auth::id())->get();
        return response()->json([
            'success' => true,
            'view' => view('production.requisition.ajax.selectedItems', compact('tempPacks'))->render()
        ]);
    }
    public function packRequisitionUpdate(Request $request)
    {

        $requisition = Requisition::find($request->requisition);
        if (count($requisition->packTempRequi)) {
            foreach ($requisition->packTempRequi as $item) {
                if ($item->qty > 0) {
                    $requsitionItem = new RequisitionItem;
                    $requsitionItem->user_id = Auth::id();
                    $requsitionItem->requisition_id = $item->requisition_id;
                    $requsitionItem->quantity = $item->qty;
                    $requsitionItem->raw_cat_id = $item->raw_cat_id;
                    $requsitionItem->pack_cat_id = $item->pack_cat_id;
                    $requsitionItem->raw_id = $item->pack_id;
                    $requsitionItem->category_id = $item->raw_cat_id;
                    $requsitionItem->dhpl_cat_id = $item->dhpl_cat_id;
                    $requsitionItem->product_id = $item->product_id;
                    $requsitionItem->product_name = $item->product_name;
                    $requsitionItem->unit = $item->unit;
                    $requsitionItem->unit_value = $item->unit_value;
                    $requsitionItem->raw_type = 'pack';
                    $requsitionItem->addedBy_id = Auth::id();
                    $requsitionItem->save();
                }
                $item->delete();
            }
            if ($request->date) {
                $requisition->date = $request->date;
            } else {
                $requisition->date = Carbon::now();
            }
            $requisition->status = 'pending';
            $requisition->pending_at = Carbon::now();
            $requisition->save();
        }
        return redirect()->back()->with('success', 'Pack Requisition Successfuly Added');
    }
}
