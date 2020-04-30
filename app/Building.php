<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'building_name', 'building_type', 'address', 'description', 'no_of_properties', 'sold_properties', 'building_group_id'
    ];

    public function buildingGroup()
    {
        return $this->belongsTo('App\BuildingGroup');
    }

    public function properties()
    {
        return $this->hasMany('App\Property');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}
