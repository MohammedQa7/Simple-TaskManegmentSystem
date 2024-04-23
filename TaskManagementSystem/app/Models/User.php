<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const ROLE_MANEGER = "Maneger";
    const DEFAULT_ROLE = "Member";
    const ROLE_OWNER = "Owner";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_position',
        'role',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'linkedin_link',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function tasks()
    {
       return $this->hasMany('App\Models\Task' , 'user_id');
    }


    public function assignedtasks()
    {
       return $this->hasMany('App\Models\Task' , 'assigned_user_id');
    }

    public function members()
    {
        return $this->belongsToMany('App\Models\Team' , 'team_user');
    }
    public function teamUser()
    {
        return $this->belongsToMany('App\Models\Team' , 'maneger_id');
    }


    public function IsOwner()
    {
        return $this->role == self::ROLE_OWNER;
    }

    public function IsManeger()
    {
        return $this->role == self::ROLE_MANEGER;
    }
    public function IsDefault()
    {
        return $this->role == self::DEFAULT_ROLE;
    }
    public function MemberOfTeam($team_id)
    {
        return $this->members()
        ->where('team_id' , $team_id)
        ->exists();
    }
    public function scopeIsMemberOfTeam($query , $team_id)
    {
        $query->whereHas('members'  , function($query) use($team_id){
            return $query->where('team_id' , $team_id);
        });
    }

    public function scopeIsMember($query)
    {
        return $query->where('role' , self::DEFAULT_ROLE);
    }
    
}
