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

    public static function boot() {
        parent::boot();

        static::deleting(function($project) { // before delete() method call this
             $project->stages()->delete();
             $project->image()->delete();
             // do the rest of the cleanup...
        });
    }
}
