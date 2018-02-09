<?php

namespace App\Services;

use App\Services\Contracts\ChatManageServiceInterface;
use App\User;

class ChatManageService implements ChatManageServiceInterface
{

    public function removePermission(User $user, $permission)
    {
        $user->disallow($permission);

       return true;
    }
}