<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//klasa modelu dla postów
class Post extends Model
{
	//uzycie softdeletes - mozliwosc oznaczanie obiektow jako usuniete, bez usuwania ich z bazy
	use SoftDeletes;

	protected $fillable = [
        'tytul', 'tresc', 'kategoria_id', 'featured', 'slug'
    ];

    //kolumna z timestampem, kiedy post został przeniesiony do kosza
    protected $dates = ['deleted_at'];
    //relacje postu z kategoria - one to one - kazdy post jedna kategoria
    public function kategoria()
    {
    	return $this->belongsTo('App\Kategoria');
    }

    //pivot table - post_id <-> tag_id => post_tag
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    //pobierz obrazek 
    public function getFeaturedAttribute($featured)
    {
        //uzyj metody asset do wygenerowania linku do zasobu
        return asset($featured);
    }
}
