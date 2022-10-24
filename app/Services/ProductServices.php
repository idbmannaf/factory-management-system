<?php

namespace App\Services;

use App\Models\Product;

class ProductServices
{
    public $product;

    public function __construct(Prdoduct $product)
    {
        $this->product = $product;
    }

}
