<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
