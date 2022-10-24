<?php

namespace App\Services;

use App\Models\Depot;

class DepotServices
{

    public $depot;

    public function __construct(Depot $depot)
    {
        $this->depot = $depot;
    }

}
