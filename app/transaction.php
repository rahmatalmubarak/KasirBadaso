<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $guarded = [];

    public function count()
    {
       transaction::where('id')->count();
    }
}
