<?php

namespace App\Http\Controllers;
use App\Models\Guest;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Notifications\PushDemo;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class PushController extends Controller
{

    public function __construct(){
//        $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request,[
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
//        $user = User::find(Auth::id());
        $user = Guest::firstOrCreate([
            'endpoint' => $endpoint
        ]);

        $user->updatePushSubscription($endpoint, $key, $token);

        return response()->json(['success' => true],200);
    }

    public function push(){
        Notification::send(Guest::all(),new PushDemo);
        return ['status' => 'success'];
    }

}
