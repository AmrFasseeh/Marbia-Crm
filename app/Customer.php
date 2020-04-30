<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'fullname', 'phone', 'email', 'job_title', 'country', 'city', 'neighbourhood', 'address',
        'date_birth', 'user_id', 'type', 'facebook', 'twitter', 'skype', 'linkedin', 'lead_stage_id',
        'lead_source', 'lead_date', 'lead_value', 'lead_message', 'cust_date', 'cust_type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function leadstage()
    {
        return $this->belongsTo('App\LeadStage');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
