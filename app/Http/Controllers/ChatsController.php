<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\MessageRequest;
use App\Message;
use App\Repositories\Contracts\MessageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ChatService;
use JavaScript;

class ChatsController extends Controller
{

    private $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->middleware('auth');
        $this->middleware('visitor');
        $this->middleware('writer')->only('sendMessage');

        $this->messageRepository = $messageRepository;
    }

    /**
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
       // dd(Auth::user()->id);
        JavaScript::put(['user' => Auth::user()->chatProfile]);

        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return mixed
     */
    public function fetchMessages()
    {

        return $this->messageRepository->getAllWith('user');
    }

    /**
     * Save message to database
     *
     * @param MessageRequest $request
     * @return array
     */
    public function sendMessage(MessageRequest $request)
    {
        $user = Auth::user();

        $message = $this->messageRepository->createByUser($request['message'], $user);

        broadcast(new MessageSent($user, $message))->toOthers();

        return response()->json(['message' => 'saved']);
    }

}
