<?php

namespace App\Services\Contracts;


use App\User;

Interface ChatManageServiceInterface
{

    public function removePermission(User $user, $permission);


}