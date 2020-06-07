<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    use SoftDeletes;
    
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

    public static function boot() {
        parent::boot();

        static::deleting(function($building) { // before delete() method call this
             $building->properties()->delete();
             $building->image()->delete();
             // do the rest of the cleanup...
        });
    }
}
