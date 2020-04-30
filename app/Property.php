<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'name',
        'property_type',
        'floor_no',
        'appartment_no',
        'bedrooms',
        'bathrooms',
        'kitchen',
        'area_sqm',
        'value',
        'payment_category',
        'description',
    ];
    public function building()
    {
        return $this->belongsTo('App\Building');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}
