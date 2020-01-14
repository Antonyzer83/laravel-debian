<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
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

    /**
     * Set the user's name
     */
    public function setNameAttribute()
    {
        if (isset($this->attributes['first_name']) && isset($this->attributes['last_name']))
            $this->attributes['name'] = $this->attributes['first_name'] . ' ' . $this->attributes['first_name'];

        $this->attributes['name'];
    }

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
}
