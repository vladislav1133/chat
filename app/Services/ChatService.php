<?php

namespace App\Services;

use App\User;
use Illuminate\Http\Request;

class ChatService
{

    /**
     * Return saved message
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function save(Request $request, User $user){

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        return $message;
    }
}