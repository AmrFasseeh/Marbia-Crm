<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'country', 'owner', 'description', 'city', 'district', 'location'];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
    public function stages()
    {
        return $this->hasMany('App\BuildingGroup');
    }
}
