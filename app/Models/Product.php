<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_units()
    {
        return $this->belongsTo(ProductUnit::class, 'product_unit_id');
    }
    
}
