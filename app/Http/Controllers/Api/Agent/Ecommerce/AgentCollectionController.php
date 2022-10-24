<?php

namespace App\Http\Controllers\Api\Agent\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Services\ImageFilter;
use Illuminate\Support\Str;
use App\Models\Ecommerce\EcommercePaymentCollection;
use App\Models\Role\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentCollectionController extends Controller
{
    use ImageFilter;
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Agent $agent,EcommercePaymentCollection $col)
    {
        $data = $col->where('agent_id', $agent->id)->latest()->with('source')->paginate(20);
        return response()->json($data, 200);
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
    public function store(Agent $agent, EcommercePaymentCollection $collection, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'source' => 'required',
            'type' => 'required',
            'paid_amount' => 'required|numeric',
            ]);

            if ($request->hasFile('image')) {
                $validator = Validator::make($request->all(),[
                    'image' => 'image',
                ]);
            }

            if ($validator->fails()) {
                return response()->json($validator->errors(), 209);
            }

            $collection->trans_date = now();
            $collection->source_id = $request->source;
            $collection->agent_id = $agent->id;
            $collection->collected_by = 'agent';
            $collection->collection_type = $request->type;
            $collection->bank_name = $request->type;
            $collection->account_number = $request->type;
            $collection->cheque_number = $request->type;
            $collection->note = $request->type;
            $collection->paid_amount = $request->paid_amount;
            
            $srCommission = round($agent->current_sale_commission / ($agent->current_sale / $request->paid_amount), 2);
            $collection->sr_commission_amount = $srCommission;

            $collection->addedby_id = auth()->user()->id;
            $collection->status = 'pending';
            $collection->save();

            if ($request->hasFile('image')) {
                $img = $this->resize($request->image, 1200,1200);
                $extension = strtolower($request->image->getClientOriginalExtension());
                $time   = Str::slug(now());
                $imgName = Str::slug($collection->id).'_'.$time.$extension;
                $img->storeAs('paymentCollection', $imgName, 'public'); //uploading on storage

                $collection->image = url('/').'/storage/paymentCollection/'.$imgName; //saving the image link
            }

            $collection->save();

            $source = $collection->source;

            // $agent->total_collection = $agent->total_collection + $collection->paid_amount;
            $agent->current_collection = $agent->current_collection + $collection->paid_amount;
            $agent->save();

            // $source->total_collection = $source->total_collection + $collection->paid_amount;
            $source->current_collection = $source->current_collection + $collection->paid_amount;
            $source->save();

            return response()->json($collection, 200);

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
    }
