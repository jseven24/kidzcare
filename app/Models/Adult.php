<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adult extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'adult_role_id'
    ];

    public function account()
    {
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }

    public function adultRole()
    {
        return $this->belongsTo('App\Models\AdultRole', 'adult_role_id', 'id');
    }

    public function children()
    {
        return $this->belongsToMany('App\Models\Child', 'children_adults', 'adult_id', 'child_id');
    }
}
