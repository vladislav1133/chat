<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 09.02.18
 * Time: 13:01
 */

namespace App\Repositories\Contracts;


use App\User;

interface MessageRepositoryInterface
{
    public function getAllWith($relation);

    public function createByUser($message, User $user);

}