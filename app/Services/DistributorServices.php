<?php
namespace App\Services;

use App\Models\Distributor;

class DistributedServices
{
    public $distributor;
    public function __construct(Distributor $distributor)
    {
        $this->distributor = $distributor;
    }

}
