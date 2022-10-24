<?php

namespace App\Http\Controllers\Web\Agent;

use App\Http\Controllers\Controller;
use App\Models\Role\Agent;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent as DeviceAgent;

class AgentDashboardController extends Controller
{
    protected $device;
    protected $minutes = 120;
    public function __construct()
    {
        // $this->middleware('locale');
        if (DeviceAgent::isDesktop()) {
            //$this->device = 'theme.'.config('app.theme').'.';
        } else {
            $this->device = 'mobile.'; //mobile and tab will use
        }
    }

    public function dashboard(Agent $agent, Request $request)
    {
        
        $agentship = $agent->load('dealer','division','district','upazila', 'markets');
        menuSubmenu('dashboard', 'dashboard');

        // return view('mobile.agent.index',[
        //     'agent' => $agentship,
        // ]);
        return view('agent.dashboard.agentDashboard', ['agent' => $agentship]);
    }

    public function index()
    {
        menuSubmenu('dashboard', 'dashboard');
        return view('mobile.agent.index');
        // return view($this->device . 'agent.index');
    }
    public function ecommerceIndex(Agent $agent)
    {
    
        if ($agent->user_id != auth()->user()->id){
            abort(401);
        }elseif($agent->active == 0){
            return view('mobile.agent.inactiveAgentIndex',[
                'agent' => $agent,
            ]);
        }else{
            $agentship = $agent->load('dealer','division','district','upazila', 'markets');
            menuSubmenu('dashboard', 'dashboard');
            
            return view('mobile.agent.index',[
                'agent' => $agentship,
            ]);
            // return view($this->device . 'agent.ecommerce.index',[
            //     'agent' => $agentship,
            // ]);
        }
        
    }
}
