<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    public function menuItem()
    {
        return $this->hasMany(MenuItem::class);
    }
}
