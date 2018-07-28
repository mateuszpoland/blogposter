<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

//Kontroler uzyty do weryfikacji emaila uzytkownika
class VerifyController extends Controller
{
    public function verify($token)
    {
    	//znajdz uzytkownika o podanym tokenie
    	$user = User::where('token', $token)->firstOrFail();
    	if($user)
    	{
    		//zaznacz w bazie jako zweryfikowanego
    		$user->update(['token' => null]);
    		return redirect()
    			->route('home')
    			->with('success', 'Konto zostało zweryfikowane.')
    	}
    }
}
