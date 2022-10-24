<?php

namespace App\Http\Controllers\Api\Agent\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Role\Agent;
use App\Models\ShipmentReturn;
use Illuminate\Http\Request;

class AgentReturnController extends Controller
{
    public function returnList(Agent $agent, ShipmentReturn $return)
    {
        $data = $return->where('agent_id', $agent->id)->withCount('items')->paginate(20);
        return response()->json($data, 200);
    }
    public function returnDetails(Agent $agent, ShipmentReturn $return)
    {
        $data = $return->find($return->id)->load('items');
        return response()->json($data, 200);
    }
}
