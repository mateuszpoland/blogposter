<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Profile;
use App\Exceptions\Handler;
use Exception;

class UsersController extends Controller
{
	/**
	* bufor błedow
	**/
	protected $fail = array();

	 public function index()
	 {
	 	$users = User::all();
	 	return view('admin.users.index')
	 				->with('users', $users)
	 				->with('fail', null);	
	 }

	 public function create()
	 {
	 	return view('admin.users.create');
	 }

	 public function store(Request $request)
	 {
	 	//dd($request->all());
	 	//exit;
	 	$this->validate($request, [
	 		'name' => 'required',
	 		'email' => 'required|email',
	 	]);
	 	sfdsf
	 	try
	 	{
	 		if(strlen($request->name) < 5 )
	 		{
	 			$this->fail['name'] = 'Nazwa użytkownika jest zbyt krótka';
	 			Throw new Exception();
	 		}

	 		if(!null == User::where('name', $request->name)->get())
	 		{
	 			$this->fail['name'] = 'Użytkownik istnieje';
	 			Throw new Exception();
	 		}

	 	}
	 	catch(Exception $e)
	 	{
	 		return redirect()->route('users.create')
	 						 ->with('fail', $this->fail);
	 	}
	 	
	 	
	 	$user = User::create([
	 		'name' => $request->name,
	 		'email' => $request->email,
	 		//uzycie pass default przy tworzeniu konta przez admina
	 		'password' => bcrypt('123123')
	 	]);
	 	

	 	//profil
	 	$profile = Profile::create([
	 		'user_id' => $user->id,
	 		//defaultowy avatar
	 		'avatar' => ''
	 	]);

	 	return redirect()->route('users.index')
	 					->with('success', 'Dodano nowego użytkownika - ' .$user->name)
	 					->with('fail', null);
	 }
}