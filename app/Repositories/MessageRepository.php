<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 09.02.18
 * Time: 13:00
 */

namespace App\Repositories;

use App\Message;
use App\Repositories\Contracts\MessageRepositoryInterface;
use App\User;

class MessageRepository implements MessageRepositoryInterface
{
    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }


    public function createByUser($message, User $user) {

        $message = $user->messages()->create([
            'message' => $message
        ]);

        return $message;
    }

    public function getAllWith($relation)
    {
        return $this->message->with($relation)->get();
    }


}