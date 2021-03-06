<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumbersGroup extends Model
{
    protected $table = 'numbers_group';

    protected $fillable = ['user_id', 'name'];


    public function numbers()
    {
        return $this->hasMany('App\Numbers');
    }

    public function scopeSyslist($query)
    {
        return $query->where('user_id', '=', '0');
    }
}
