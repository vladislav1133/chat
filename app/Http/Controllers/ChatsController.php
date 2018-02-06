<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\Services\ChatRuleValidator;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ChatsController extends Controller
{
    private $chatRuleValidator;
    public function __construct(ChatRuleValidator $chatRuleValidator)
    {
        $this->middleware('auth');
        $this->chatRuleValidator = $chatRuleValidator;
    }

    /**
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

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
    public function sendMessage(Request $request)
    {

        $user = Auth::user();

        $errors = $this->chatRuleValidator->validate($user,$request['message']);
        if (count($errors)) return response()->json(['status' => 400, 'error' => $errors[0]]);


        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return response()->json(['status' => 200]);
    }


}
