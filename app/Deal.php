<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'id',
        'title',
        'value',
        'currency',
        'source',
        'due_date',
        'won_date',
        'deal_stages_id',
        'status',
        'payment_method',
        'property_id',
        'customer_id',
        'user_id',
    ];
    public function dealstages()
    {
        return $this->hasOne('App\DealStages');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function property()
    {
        return $this->belongsTo('App\Property');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
