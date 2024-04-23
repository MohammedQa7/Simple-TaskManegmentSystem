<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'maneger_id'
    ];

    public function teamManeger()
    {
        return $this->belongsTo('App\Models\User' , 'maneger_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\User' , 'team_user');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task' , 'team_id');
    }

    public function scopeManegerTeams($query)
    {
        $query->where('maneger_id' , Auth::user()->id);
    }

    public function scopeSearch($query , $search_query)
    {
        $query->where('name' , 'LIKE' , "%{$search_query}%");
    }
    public function scopeMembersTeams($query)
    {
        $query->whereHas('members' , function ($query)
        {
            return $query->where('user_id' , Auth::user()->id);
        });
    }
    public function scopeCheckForTeamMemeber($query  , $user_id)
    {
        return $this->members()->where('user_id' , $user_id)->exists();
    }

    public function scopeCheckForTeamManeger($query  , $maneger_id)
    {
        return $query->where('maneger_id' , $maneger_id)->exists();
    }
}
