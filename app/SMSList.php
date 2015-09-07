<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSList extends Model
{
    protected $table = 'smslist';

    protected $fillable = ['user_id', 'message', 'smoothly', 'start', 'stop', 'period', 'draft'];

    public function messages()
    {
        return $this->hasMany('App\Messages', 'smslist');
    }
    public function scopeDraft($query)
    {
        return $query->where('draft', true);
    }
    public function scopeNotdraft($query)
    {
        return $query->where('draft', false);
    }
}
