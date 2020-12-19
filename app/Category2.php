<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category2 extends Model
{
    public $timestamps = false;

    protected $table = 'category2';

    public function menu()
    {
        return $this->hasMany('App\Menu');
    }
}
