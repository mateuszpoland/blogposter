<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategoria extends Model
{
	protected $fillable = ['nazwa'];
    //ustalam relacje z Postami - one to many - jedna kategoria ma wiele postów
    public function posts()
    {
    	return $this->hasMany(App\Post);
    }

    public static function find_by_name(string $name) : Kategoria
    {
    	$cats = Kategoria::all();
    	foreach($cats as $cat)
    	{
    		echo $cat->nazwa;
    	}
    }
}
