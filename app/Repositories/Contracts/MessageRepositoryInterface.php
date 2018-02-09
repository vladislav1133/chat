<?php

namespace App\Repositories\Contracts;


use App\User;

interface MessageRepositoryInterface
{
    /**
     * Get all Message with specified relation
     *
     * @param $relation
     * @return mixed
     */
    public function getAllWith($relation);

    /**
     * Create message
     *
     * @param $message
     * @param User $user
     * @return mixed
     */
    public function createByUser($message, User $user);

}