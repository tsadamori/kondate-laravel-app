<?php

namespace App\Interfaces;

use App\User;

interface UserRepositoryInterface
{
    public function getAllUsers(): User;
    public function getUser(int $id): User;
}