<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kondate extends Model
{
    protected $table = 'kondate';

    public function menus()
    {
        return $this->hasMeny('App\Menu');
    }
}
