<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //ustala, czy uzytkownik jest zweryfikowany czy nie
    public function verified()
    {
        return $this->token === null;
    }
    /*
    public function sendVerificationEmail()
    {
        $this->notify(new VerifyEmail($this));
    }
    */

    //relacja z profilem użytkownika
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }
}
