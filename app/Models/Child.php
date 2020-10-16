<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'gender',
        'group_id',
        'rate',
        'picture',
        'is_allergic',
        'notes'
    ];


    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    public function adults()
    {
        return $this->belongsToMany('App\Models\Adult', 'children_adults', 'child_id', 'adult_id');

    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'children_users', 'child_id', 'user_id');
    }

    public function getSiblings($child_id, $adult_id)
    {
        $siblings = $this::where('children.id', '!=', $child_id)
            ->whereHas('adults', function($query) use ($adult_id){$query->where('adults.id', $adult_id);})
            ->get();

        if (!$siblings->isEmpty()) {
            return $siblings;
         }else{
            return false;
         }
    }

    public function getAccountHolder($child_id){
        return $this->adults()->where('adult_role_id', 1)
        ->whereHas('children', function($query) use ($child_id){$query->where('children.id', $child_id);})
        ->first();
    }


    public function getAge($dob)
    {
        //return Carbon::parse($dob)->age;
        return Carbon::createFromDate($dob)->diff(Carbon::now())->format('%y years, %m months');
    }





}
