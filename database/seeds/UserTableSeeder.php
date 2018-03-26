<?php
use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{

	public function run()
	{
	    DB::table('users')->delete();
	    User::create(array(
	        'name'     => 'Administrador',	        
	        'email'    => 'rap@uneatlantico.es',
	        'password' => Hash::make('admin'),
	    ));
	}
	//composer dump-autoload
}
