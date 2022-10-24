<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DhplCategory extends Model
{
    protected $table = 'ecommerce_categories';
    protected $connection = 'dhpl';

}
