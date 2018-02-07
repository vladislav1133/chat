<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ChatService;


class ChatsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('role:admin');
        //$this->middleware('permission:can visit');
    }

    /**
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $user = Auth::user();

        //$user->hasPermissionTo('visit page');
        dump($user->getRoleNames());
        $user->givePermissionTo('visit-page','web');
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return mixed
     */
    public function fetchMessages()
    {


        return Message::with('user')->get();
    }

    /**
     * Save message to database
     *
     * @param Request $request
     * @return array
     */
    public function sendMessage(MessageRequest $request)
    {

        $user = Auth::user();

        $message = ChatService::save($request,$user);

        broadcast(new MessageSent($user, $message))->toOthers();

        return response()->json(['status' => 200]);
    }


}
