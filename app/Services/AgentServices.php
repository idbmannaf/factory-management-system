<?php

namespace App\Services;

use App\Models\Agent;

class AgentServices
{
    public $agent;

    public function __construct(Agent $agent)
    {
        $this->agent = $agent;
    }

}
