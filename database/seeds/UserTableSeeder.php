<?php
use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{

	public function run()
	{
	    DB::table('users')->delete();
	    User::create(array(
	        'name'     => 'lazaro.hernandez',
	        'email'    => 'rap@uneatlantico.es',
	        'password' => Hash::make('tuTUhY1y'),
					'type'     => 'admin',
	    ));
	}
	//composer dump-autoload
}
