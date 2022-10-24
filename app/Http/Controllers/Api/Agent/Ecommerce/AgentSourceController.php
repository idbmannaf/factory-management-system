<?php

namespace App\Http\Controllers\Api\Agent\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\EcommerceSource;
use App\Models\Role\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentSourceController extends Controller
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
    public function store(Agent $agent, User $user, EcommerceSource $source, Request $request)
    {
        $source->user_id        = $user->id;
        $source->addedby_id     = auth()->user()->id;
        $source->email          = $user->email;
        $source->mobile         = $user->mobile;
        $source->mobile_optional = $request->mobile_optional ?: null;
        $source->name           = ['en'=> $request->name, 'bn' => $request->name_bn ?? ''];
        $source->slogan         = ['en'=> $request->slogan, 'bn' => $request->slogan_bn ?? ''];
        $source->description    = ['en'=> $request->description, 'bn' => $request->description_bn ?? ''];
        $source->address        = ['en'=> $request->address, 'bn' => $request->address_bn ?? ''];
        $source->type           = $request->type ?: null;
        $source->depo_id        = $agent->depo_id;
        $source->distributor_id = $agent->distributor_id;
        $source->dealer_id      = $agent->dealer_id;
        $source->agent_id       = $agent->id;
        $source->division_id    = $agent->division_id;
        $source->district_id    = $agent->district_id;
        $source->upazila_id     = $agent->upazila_id;
        $source->market_id      = $request->market;
        // dd($source);
        $source->save();

        return response()->json($source, 200);
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

    public function getSourcesByUser(Agent $agent, User $user)
    {
        $sources = $user->sources;
        return response()->json($sources, 200);
    }

    public function getMarketsByAgent(Agent $agent)
    {
        $markets = $agent->upazila->markets->toArray();
        return response()->json($markets, 200);
    }

    public function getUsers(Agent $agent)
    {
        $users = $agent->createdUsers()->paginate(10);
        return response()->json($users, 200);
    }
    public function getSources(Agent $agent)
    {
        $data = $agent->createdSources()->latest()->paginate(20);
        return response()->json($data, 200);
    }

    public function storeShop(Agent $agent, EcommerceSource $source, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric|string|unique:ecommerce_sources,mobile',
            'owner_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type' => 'required',
            'address' => 'required',
            'due_amount' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 209);
        }
        $source->addedby_id     = auth()->user()->id;
        $source->mobile         = $request->mobile;
        $source->owner_name     = $request->owner_name;
        $source->initial_amount = $request->due_amount;
        $source->due_amount     = $request->due_amount;
        $source->mobile_optional = $request->mobile_optional ?: null;
        $source->name           = ['en'=> $request->name, 'bn' => $request->name_bn ?? ''];
        // $source->slogan         = ['en'=> $request->slogan, 'bn' => $request->slogan_bn ?? ''];
        $source->description    = ['en'=> $request->description, 'bn' => $request->description_bn ?? ''];
        $source->address        = ['en'=> $request->address, 'bn' => $request->address_bn ?? ''];
        $source->type           = $request->type ?: null;
        $source->depo_id        = $agent->depo_id;
        $source->distributor_id = $agent->distributor_id;
        $source->dealer_id      = $agent->dealer_id;
        $source->agent_id       = $agent->id;
        $source->active         = 0;
        $source->division_id    = $agent->division_id;
        $source->district_id    = $agent->district_id;
        $source->upazila_id     = $agent->upazila_id;
        // dd($source);
        $source->save();

        return response()->json($source, 200);
    }

    public function shopSearch(Agent $agent, Request $request)
    {
        $q  = $request->q;
        $data = EcommerceSource::where('agent_id', $agent->id)->where(function($query) use ($q){
            $query->where('name', 'like', '%'.$q.'%');
            $query->orWhere('mobile', 'like', '%'.$q.'%');
        })
        ->where('active', true)

        // ->orWhere('username', 'like', '%'.$request->q.'%')
        // ->orWhere('name', 'like', '%'.$request->q.'%')
        // ->orWhere('mobile', 'like', '%'.$request->q.'%')
        ->select(['id','name','mobile'])->take(30)->get();
        return response()->json($data, 200);
    }

    public function shopDetails(Agent $agent, $source)
    {
        $shop = EcommerceSource::find($source);
        if ($shop && $shop->agent_id == $agent->id ) {
            return response()->json($shop, 200);
        }
        return response()->json($shop, 209);
    }

    public function searchSources(Agent $agent, Request $request)
    {
        if ($request->query) {
            $keyword = $request->all();
            $data = EcommerceSource::where('agent_id', $agent->id)
            ->where(function($query) use ($keyword){
                $query->where('id', 'LIKE' , "{$keyword['query']}%")
                    ->orwhere('mobile', 'LIKE' , "%{$keyword['query']}%")
                    ->orWhere('name', 'LIKE', "%{$keyword['query']}%")
                    ->orWhere('owner_name', 'LIKE', "%{$keyword['query']}%")
                    ;})
            ->paginate(20);
            return response()->json($data, 200);
        }
        return response()->json('error', 209);
    }
}
