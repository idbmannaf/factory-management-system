<?php

namespace App\Http\Controllers\Api\Agent;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommercePaymentCollection;
use App\Models\Role\Agent;
use App\Models\SaleCommission;
use App\Models\SrLocation;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgentDashboardController extends Controller
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

    public function getAgentships()
    {
        $agentships = auth()->user()->agents->load('dealer','division','district','upazila', 'markets')->toArray();
        return response()->json($agentships, 200);
    }

    public function saveUser(Agent $agent, Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'mobile' => 'required|string|max:255|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 209);
        }
        $randPass = rand(100000,999999);
        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password_temp' => $randPass,
            'password' => Hash::make($randPass),
            'addedby_type' => 'App\Models\Role\Agent',
            'addedby_id' => $agent->id,
        ]);

        return response()->json($user, 200);
    }

    public function getAgentInfo(Agent $agent)
    {
        $data = $agent->find($agent->id)->load('user');

        return response()->json($data, 200);
    }
    public function getAgentDashboardInfo(Agent $agent)
    {
        $currentMonthSale = SaleCommission::where('agent_id', $agent->id)->whereMonth('tr_date', now()->month)->sum('total_price');
        $currentMonthCollection = EcommercePaymentCollection::where('agent_id', $agent->id)->where('status', 'varified')->whereMonth('created_at', now()->month)->sum('paid_amount');
        $agentInfo = $agent->find($agent->id)->load('user');
        $data = [
            'agent' => $agentInfo,
            'current_month_sale' => $currentMonthSale,
            'current_month_collection' => $currentMonthCollection,
        ];
        return response()->json($data, 200);
    }

    public function setAgentLocation(Agent $agent, SrLocation $srLocation, Request $request, Client $client)
    {
        if ($agent->user_id == auth()->user()->id) {
            $srLocation->user_id = auth()->user()->id;
            $srLocation->agent_id = $agent->id;
            $srLocation->lat = $request->lat;
            $srLocation->lng = $request->lng;
            $srLocation->save();
            $url = url("http://poi.18gps.net/poi?lat={$request->lat}&lon={$request->lng}");
            $r = $client->request('GET', $url);
            $result = $r->getBody()->getContents();
            $srLocation->location = $result ?? '';
            $srLocation->save();
            
            $agent->srLocations()->whereMonth('created_at', '<', now()->subMonths(2)->month)->delete();
        }else{
            abort(401);
        }
    }
    public function getAgentSalary(Agent $agent)
    {
        if ($agent->user_id != auth()->user()->id) {
            abort(401);
        }else{
            $data = $agent->salaries()->latest()->paginate(50);
            return response()->json($data, 200);
        }
    }
}
