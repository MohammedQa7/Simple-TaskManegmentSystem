<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    const DEFAULT_STATUS = 'not_completed';
    use HasFactory;
    protected $fillable =[
        'name',
        'slug',       
        'priority',
        'description',
        'status',
        'user_id',
        'assigned_user_id',
        'team_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User' , 'user_id');
    }
    public function assigneduser()
    {
        return $this->belongsTo('App\Models\User' , 'assigned_user_id');
    }

    public function tasks()
    {
        return $this->belongsTo('App\Models\Team' , 'team_id');
    }

    public function scopeSearch($qurey , $search_query)
    {
        return $qurey->where('name' ,'LIKE' , "%{$search_query}%");
    }


    public function scopeManegerTasks($query)
    {
        return $query->whereHas('user' , function($query){
            $query->where('id' , Auth::user()->id);
        });
    }

    public function scopeMemberTasks($query)
    {
        return $query->whereHas('assigneduser' , function($query){
            $query->where('id' , Auth::user()->id);
        });
    }

}
