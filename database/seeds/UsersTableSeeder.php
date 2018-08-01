<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = App\User::create([
        	'name' => 'Admin',
        	'email' => 'admin@blogposter.com',
        	'password' => bcrypt('123123'),
            'admin' => 1,
        ]);
        
        //$user = DB::table('users')->where('name', 'Admin')->first();
        //stworzenie profilu dla uzytkownika
        App\Profile::create([
            'user_id' => $user->id,
            'avatar' => '/public/uploads/avatars/admin.jpeg',
            'about' => 'Jestem zwyczajnym adminem.',
            'facebook' => 'https://www.facebook.com/mateusz.kowalewski.925',
            'website' => 'https://mateuszpoland.github.io',
            'youtube' => 'youtube.com',
        ]);
    }
}
