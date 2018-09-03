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

	public function __construct()
	{
		$this->middleware('admin');
	}

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

	 	$fail = array();

	 	try
	 	{
	 		if(strlen($request->name) < 5)
	 		{
	 			$fail['name'] = 'Nazwa użytkownika jest zbyt krótka.';
	 			Throw new Exception();
	 		}

	 		if(!null == User::where('name', $request->name)->first())
	 		{
	 			$fail['name'] = 'Użytkownik istnieje. Wybierz inną nazwę użytkownika';
	 			Throw new Exception();
	 		}

	 		if(!null == User::where('email', $request->email)->first())
	 		{
	 			$fail['email'] = 'Podany email jest już zajęty.';
	 			Throw new Exception();
	 		}

	 	}
	 	catch(Exception $e)
	 	{
	 		return redirect()->route('users.create')
	 						 ->with('fail', $fail);
	 	}
	 	
	 	
	 	$user = User::create([
	 		'name' => $request->name,
	 		'email' => $request->email,
	 		//uzycie pass default przy tworzeniu konta przez admina
	 		'password' => bcrypt('123123')
	 	]);
	 	

	 	//profil domyslny
	 	$profile = Profile::create([
	 		'user_id' => $user->id,
	 		//defaultowy avatar
	 		'avatar' => '/public/uploads/avatars/def_avatar.jpeg',
	 	]);

	 	return redirect()->route('users.index')
	 					->with('success', 'Dodano nowego użytkownika - ' .$user->name)
	 					->with('fail', null);
	 }

	 public function privileges(Request $request)
	 {
	 	
	 	if(empty($request->user_id))
	 	{
	 		return redirect()->back();
	 	}

	 	$user = User::find($request->user_id);

	 	if($request->admin == 'on')
	 	{
	 		$user->admin = 1;
	 		$user->user = 1;
	 		$user->edit = 1;
	 		$user->save();
	 		return redirect()->back();
	 	}
	 	$user->admin = 0;
	 	$user->edit = ($request->edit == 'on') ? 1 : 0;
	 	$user->user = ($request->user == 'on') ? 1 : 0;
	 	$user->save();
	 	return redirect()->back()
	 					 ->with('success', 'Zmieniono uprawnienia.');

	 }
}