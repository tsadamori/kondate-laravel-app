<?php

namespace App\Interfaces;

use App\User;
use App\Repositories\UserRepository;

interface UserServiceInterface
{
  public function indexUsers(): User;
  public function getUser(int $id): User;
  public function updateUser(int $id, array $payload): User;
  public function deleteUser(int $id): void;
}