<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;


    public function children()
    {
        return $this->hasMany('App\Models\Child', 'group_id', 'id');
    }
}
