<?php

namespace App\Services;

interface UserServiceInterface
{
  public function getUsers();
  public function getUser(int $id);
}