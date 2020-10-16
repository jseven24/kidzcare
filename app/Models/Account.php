<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public function adults()
    {
        return $this->hasMany('App\Models\Adult', 'account_id', 'id');
    }
}
