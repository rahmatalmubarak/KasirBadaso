<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Product::class);
    }
}
