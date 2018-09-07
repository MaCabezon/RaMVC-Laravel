<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\NotificacionToUser;
use App\User;
use DB;
use Carbon\Carbon ;

class NotificacionController extends Controller
{
    public function index()
    {       
        $users=User::where('id','!=',auth()->id())->get();
        return view('notificaciones.index',compact('users'));
    }
    
    public function store(Request $request)
    {        
    
        if (auth()->id() != $request->recipient_id) {
            $user =User::find(auth()->id());
            $user->notify(new NotificacionToUser($request->body));
        }
        
        return view('home', $request->recipient_id);
    }

    public function marcarLeidas()
    {
        $user = User::find(auth()->id());
        
        DB::table('notifications')
        ->where('notifiable_id', $user->id)
        ->update(['read_at' => Carbon::now()]);

        return view('home');
    }
}
