<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = ['title', 'start', 'end', 'description', 'color'];

    public function eventable()
    {
        return $this->morphTo();
    }
}
