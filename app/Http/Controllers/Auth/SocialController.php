<?php

namespace App\Http\Controllers\Auth;

use App\Entities\SocialLite\SocialEntity;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

use App\User;
use DB, Session;


class SocialController extends Controller
{
//Redirecciona el navegador al proveedor de oauth correspondiente
    public function getSocialRedirect( $provider )
    {
        $providerKey = Config::get('services.' . $provider);
        if (empty($providerKey)) {
            return view('pages.status')
                ->with('error','No such provider');
        }
        return Socialite::driver( $provider )->redirect();
    }

    // Recibe el login exitoso del proveedor, crea el usuario si no existe y si existe actualiza valores,
    // también guarda el id de usuario del proveedor.
    public function getSocialHandle($provider)
    {
        if (Input::get('denied') != '')
            abort(500, "No le diste permiso a nuestra aplicación para acceder a tu cuenta.");
        //Datos de usuario retornados por el proveedor de servicio
        $socialUser = Socialite::driver($provider)->user();

        // Verifica si el email ya lo tiene un usuario
        $userInDB = User::where('email', '=', $socialUser->email)->get()->first();

        if($userInDB==null){
            // Filtrado de usuarios
           // if(str_after($socialUser->email,'@')!='uneatlantico.es' && !$userInDB->hasRole('admin') && !$userInDB->hasRole('member') && !$userInDB->hasRole('user') ) {
                return redirect('/');
           // }
        }


         // Si no lo tiene crea el usuario
        /*if(empty($userInDB)) {
            $userInDB = new User;
            $userInDB->password = bcrypt(str_random(16));
            $userInDB->token = str_random(64);
            $userInDB->email = $socialUser->email;
            $userInDB->name = $socialUser->name; // Actualiza el name
            $userInDB->save();

            if ($socialUser->email == "rap@uneatlantico.es") {
                $userInDB->assignRole('admin');
            } else if (str_before($socialUser->email,'@')== 'abraham.fernandez' || str_before($socialUser->email,'@')== 'sara.berbil'|| str_before($socialUser->email,'@')== 'loyda.alas'  || str_before($socialUser->email,'@')== 'larisa.hernandez') {
                $userInDB->assignRole('member');
            } else {
                $userInDB->assignRole('user');
            }

        }*/



        // Guarda el id oauth del proveedor de Oauth
        // $sameSocialId = new SocialEntity;
        DB::table('social_logins')->where('social_id', '=', $socialUser->id)
            ->where('provider', '=', $provider )
            ->get()
            ->first();

        if (empty($sameSocialId)) {
            $socialData = new SocialEntity;
            $socialData->social_id = $socialUser->id;
            $socialData->provider= $provider;
            $userInDB->social()->save($socialData);
        } else {
          $userInDB = null;
        }
        auth()->login($userInDB, true); // Autentica al usuario

        if ($userInDB!=null) {
          Session::flash('user',$userInDB);

        }

        return redirect('/home');
    }
}
?>
