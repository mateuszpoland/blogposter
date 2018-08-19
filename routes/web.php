<?php

/*Routing testowy */
Route::get('/test', function(){
	///return App\Post::find(2)->category;
	//return App\Post::find(11)->tags;
	//return App\Profile::find(1)->user;
	return App\User::find(1)->profile; // -> "SELECT * FROM profiles p INNER JOIN users AS u ON u.id = p.user_id WHERE u.id = 1"

});

Route::get('/', function () {
    return view('welcome');
});

//routing dla autentyfikcaji
Auth::routes();
//dodatkowy route dla potwierdzenia emaila
Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');


			//parametry grupy -> dodaj prefix przed kazdym z adresow w grupie
			//middleware - przekaz request tylko, jezeli user jest zarejestrowanym adminem		
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
	//Closure
	//strona domowa panelu admina
	Route::get('/home', ['uses' => 'HomeController@index', 'as' => 'admin.home']);
	//stworz nowy post
	Route::get('/posts/create', [
		'uses' => 'PostsController@create',
		'as' => 'posts.create'
	]);
	//dodaj post do bazy
	Route::post('/posts/store', [
		'uses' => 'PostsController@store',
		'as' => 'posts.store'
	]);
	//post do kosza
	Route::get('/posts/delete/{id}', [
		'uses' => 'PostsController@destroy',
		'as' => 'posts.delete'
	]);
	//usun post
	Route::get('/posts/kill/{id}', [
		'uses' => 'PostsController@kill',
		'as' => 'posts.kill'
	]);
	//edytuj post
	Route::get('/posts/edit/{id}', [
		'uses' => 'PostsController@edit',
		'as' => 'posts.edit'
	]);
	//update
	Route::post('/posts/update/{id}', [
		'uses' => 'PostsController@update',
		'as' => 'posts.update',
	]);
	//przywroc post
	Route::get('/posts/restore/{id}', [
		'uses' => 'PostsController@restore',
		'as' => 'posts.restore'
	]);
	//wyswietl wszystkie posty
	Route::get('/posts', [
		'uses' => 'PostsController@index',
		'as' => 'posts.index',
	]);
	//wyswietl kosz
	Route::get('/posts/trash', [
		'uses' => 'PostsController@trashed',
		'as' => 'posts.trash',
	]);
	//stworz nowa kategorie 
	Route::get('/category/create', [
		'uses' => 'CategoriesController@create',
		'as' => 'category.create'
	]);
	//zapisz kategorie
	Route::post('/category/store', [
		'uses' => 'CategoriesController@store',
		'as' => 'category.store'
	]);
	//edytuj kategorię
	Route::get('category/edit/{id}', [
		'uses' => 'CategoriesController@edit',
		'as' => 'category.edit'
	]);
	//usun kategorie
	Route::get('category/delete/{id}', [
		'uses' => 'CategoriesController@delete',
		'as' => 'category.delete'
	]);
	//update kategorii
	Route::post('category/update', [
		'uses' => 'CategoriesController@update',
		'as' => 'category.update',
	]);

	//zobacz liste kategorii
	Route::get('/categories', [
		'uses' => 'CategoriesController@index',
		'as' => 'categories'
	]);

	/* TAGI */
	Route::post('tags/store', [
		'uses' => 'TagsController@store',
		'as' => 'tags.store'
	]);
	Route::post('tags/update', [
		'uses' => 'TagsController@update',
		'as' => 'tags.update'
	]);
	Route::get('/tags', [
		'uses' => 'TagsController@index',
		'as' => 'tags.index'
	]);

	Route::get('tags/edit/{id}', [
		'uses' => 'TagsController@edit',
		'as' => 'tags.edit'
	]);

	Route::get('tags/delete/{id}', [
		'uses' => 'TagsController@delete',
		'as' => 'tags.delete'
	]);

	Route::get('/users', [
		'uses' => 'UsersController@index',
		'as' => 'users.index'
	]);

	Route::get('users/create', [
		'uses' => 'UsersController@create',
		'as' => 'users.create'
	]);

	Route::post('users/store', [
		'uses' => 'UsersController@store',
		'as' => 'users.store'
	]);

	Route::post('users/privileges', [
		'uses' => 'UsersController@privileges',
		'as' => 'users.privileges',
	]);

});


