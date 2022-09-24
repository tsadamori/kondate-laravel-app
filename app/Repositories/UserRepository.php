<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(): User
    {
        return User::findAll()->paginate(10);
    }

    public function getUser(int $id): User
    {
        return User::findOrFail($id);
    }
}
