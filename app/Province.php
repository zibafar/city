<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function counties()
    {
        return $this->hasMany(County::class);
    }
}
