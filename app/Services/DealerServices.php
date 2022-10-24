<?php

namespace App\Services;

class DealerServices
{
    public $dealer;

    public function __construct(Dealer $dealer)
    {
        $this->dealer = $dealer;
    }

}
