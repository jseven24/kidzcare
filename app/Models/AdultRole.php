<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdultRole extends Model
{
    use HasFactory;

    public function adults()
    {
        return $this->hasMany('App\Models\Adult', 'adult_role_id', 'id');
    }
}
