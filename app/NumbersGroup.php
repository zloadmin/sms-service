<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumbersGroup extends Model
{
    protected $table = 'numbers_group';

    protected $fillable = ['name'];


    public function numbers()
    {
        return $this->hasMany('App\Numbers');
    }

}
