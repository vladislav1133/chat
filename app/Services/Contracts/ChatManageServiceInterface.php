<?php

namespace App\Services\Contracts;


use App\User;

Interface ChatManageServiceInterface
{

    /**
     * Remove permission from specified User
     *
     * @param User $user
     * @param $permission
     * @return bool
     */
    public function removePermission(User $user, $permission);


}