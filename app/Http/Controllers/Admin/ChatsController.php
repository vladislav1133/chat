<?php

namespace App\Http\Controllers\Admin;

use App\Events\BanUser;
use App\Events\UserManage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class ChatsController extends Controller
{
    public function muteUser($id) {

        $user = User::findOrFail($id);
        $user->disallow('write-message');

        broadcast(new UserManage($user,'mute'));
        return response()->json(['muted' => true, 'message' => 'The user is muted']);
    }

    public function banUser($id) {

        $user = User::findOrFail($id);
      //  $user->disallow('visit-page');

        broadcast(new UserManage($user,'ban'));
        return response()->json(['banned' => true, 'message' => 'The user is banned']);
    }
}
