<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserManage;
use App\Services\Contracts\ChatManageServiceInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class ChatsController extends Controller
{

    private $chatManageService;

    public function __construct(ChatManageServiceInterface $chatManageService)
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->chatManageService = $chatManageService;
    }

    public function muteUser($id) {

        $user = User::findOrFail($id);

        $this->chatManageService->removePermission($user,'write-message');

        broadcast(new UserManage($user,'mute'));

        return response()->json(['muted' => true, 'message' => 'The user is muted']);
    }

    public function banUser($id) {

        $user = User::findOrFail($id);

        $this->chatManageService->removePermission($user,'visit-page');

        broadcast(new UserManage($user,'ban'));

        return response()->json(['banned' => true, 'message' => 'The user is banned']);
    }
}
