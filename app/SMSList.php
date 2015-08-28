<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSList extends Model
{
    protected $table = 'smslist';

    protected $fillable = ['*'];

    public function messages()
    {
        return $this->hasMany('App\Messages');
    }
}
