<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category1 extends Model
{
    public $timestamps = false;

    protected $table = 'category1';

    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
}
