<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function foo\func;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'password', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function __construct($attributes = array())
    {
        parent::__construct($attributes);
        $this->attributes = $attributes;
    }


    /*
     * Set the user's name
     *
    public function setNameAttribute()
    {
        $this->attributes['name'] = $this->attributes['first_name'] . ' ' . $this->attributes['first_name'];
    }
    */

    /*
    public function setPasswordAttribute()
    {
        $this->attributes['password'] = Hash::make($this->attributes['password']);
    }
    */

    /**
     * The skills that belong to the user
     */
    public function skills()
    {
        return $this->belongsToMany('App\Skill')->withPivot('level');
    }

    /**
     * The skills that not belong to the user
     */
    public function availableSkills()
    {
        $ids = DB::table('skill_user')->where('user_id', $this->id)->pluck('skill_id');
        return Skill::whereNotIn('id', $ids)->get();
    }
}
