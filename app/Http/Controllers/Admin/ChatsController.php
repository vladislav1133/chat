<?php

namespace App\Http\Controllers\Admin;

use App\Events\BanUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class ChatsController extends Controller
{
    public function muteUser($id) {

        $user = User::findOrFail($id);

        if ($user->can('write-message')) {
            $user->disallow('write-message');

            return response()->json(['muted' => true, 'message' => 'The user is muted']);
        }

        return response()->json(['muted' => true, 'message' => 'The user already muted']);
    }

    public function banUser($id) {

        $user = User::findOrFail($id);
        $user->disallow('write-message');

        broadcast(new BanUser());
        return response()->json(['banned' => true, 'message' => 'The user is banned']);
    }
}
