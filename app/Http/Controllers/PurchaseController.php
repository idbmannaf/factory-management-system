<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function dashboard()
    {
        return view('purchase.dashboard');
    }
    public function requisitions(Request $request)
    {
        $type = $request->type;
        menuSubmenu('requisition', $type);
        if ($type == 'all') {
            $requisitions = Requisition::orderByRaw("FIELD(status,'pending','collected','approved','stocked')")->where('status', '!=', 'temp')->orderBy('id', 'DESC')->get();
        } elseif ($type == 'pending') {
            $requisitions = Requisition::where('status', 'pending')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'approved') {
            $requisitions = Requisition::where('status', 'approved')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        }elseif ($type == 'pending_purchase') {
            $requisitions = Requisition::where('status', 'pending_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'approved_purchase') {
            $requisitions = Requisition::where('status', 'approved_purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'purchase') {
            $requisitions = Requisition::where('status', 'purchase')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        }  elseif ($type == 'collected') {
            $requisitions = Requisition::where('status', 'collected')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } elseif ($type == 'stocked') {
            $requisitions = Requisition::where('status', 'stocked')->where('status', '!=', 'temp')->orderBy('id', 'DESC')->paginate(50);
        } else {
            return back();
        }

        return view('purchase.requisition.requisitionAll', compact('requisitions', 'type'));
    }
    public function requisitionProcess(Request $request)
    {

        $requisition = Requisition::find($request->requisition);
        $suppliers = Supplier::where('active', true)->orderBy('name')->get();
        return view('purchase.requisition.requisition', compact('requisition','suppliers'));
    }
}
