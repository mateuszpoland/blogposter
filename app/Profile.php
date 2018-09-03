<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['avatar', 'about', 'website', 'youtube', 'user_id', 'facebook'];

    //powiazanie z kontem uzytkownika
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
