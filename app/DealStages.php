<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealStages extends Model
{
    protected $fillable = ['title', 'headerBg'];

    public function deals()
    {
        return $this->hasMany('App\Deal');
    }
}
