<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DhplProduct extends Model
{
    protected $table = 'ecommerce_products';
    protected $connection = 'dhpl';

}
