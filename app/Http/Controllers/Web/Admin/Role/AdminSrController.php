<?php

namespace App\Http\Controllers\Web\Admin\Role;

use App\Http\Controllers\Controller;
use App\Models\Role\Agent;
use App\Models\SrSalary;
use Illuminate\Http\Request;

class AdminSrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

    public function shopList(Agent $agent)
    {
        $shops = $agent->createdSources()->latest()->paginate(50);
        return view('admin.roles.sr.shopList', [
            'agent' => $agent,
            'shops' => $shops,
        ]);
    }
    public function orderList(Agent $agent)
    {
        $orders = $agent->orders()->latest()->paginate(50);
        return view('admin.roles.sr.orderList', [
            'agent' => $agent,
            'orders' => $orders,
        ]);
    }
    public function collectionList(Agent $agent)
    {
        $collections = $agent->collections()->latest()->paginate(50);
        return view('admin.roles.sr.collectionList', [
            'agent' => $agent,
            'collections' => $collections,
        ]);
    }
    public function returnList(Agent $agent)
    {
        $returns = $agent->returns()->latest()->paginate(50);
        return view('admin.roles.sr.returnList', [
            'agent' => $agent,
            'returns' => $returns,
        ]);
    }
    public function commissionList(Agent $agent)
    {
        menuSubmenu('commissions', 'allCommissions');
        $commissions = $agent->commissions()->latest()->paginate(50);
        return view('admin.roles.sr.commissionList', [
            'agent' => $agent,
            'commissions' => $commissions,
        ]);
    }
    public function locationList(Agent $agent)
    {
        $locations = $agent->srLocations()->latest()->paginate(100);
        return view('admin.roles.sr.locationList', [
            'agent' => $agent,
            'locations' => $locations,
        ]);
    }
    public function salaryList(Agent $agent)
    {
        $salaries = $agent->salaries()->latest()->paginate(100);
        return view('admin.roles.sr.salaryList', [
            'agent' => $agent,
            'salaries' => $salaries,
        ]);
    }

    public function salaryPay(Agent $agent, Request $request)
    {
        $this->validate($request, [
            'payment' => 'required|numeric',
        ]);

        if ($request->payment > $agent->current_income || $request->payment < 1) {
            return redirect()->back()->with('error', 'Payment Amount is not correct.');
        }else{
            $srSalary = new SrSalary;
            $srSalary->agent_id = $agent->id;
            $srSalary->previous_income = $agent->current_income;
            $srSalary->paid_amount = $request->payment;
            $srSalary->current_income = ($agent->current_income - $request->payment);
            $srSalary->addedby_id = auth()->user()->id;
            $srSalary->trans_date = now();
            $srSalary->save();

            $agent->current_income = $agent->current_income - $request->payment;
            $agent->save();

            return redirect()->back()->with('success', $agent->name.' is paid BDT '.$request->payment);
        }
    }
    
}
