<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;

    public function category1()
    {
        return $this->belongsTo('App\Category1');
    }

    public function category2()
    {
        return $this->belongsTo('App\Category2');
    }

    public function kondate()
    {
        return $this->belongsTo('App\Kondate');
    }
}
