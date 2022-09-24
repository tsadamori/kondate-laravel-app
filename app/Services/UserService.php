<?php

namespace App\Services;

use App\User;
use App\Repositories\UserRepository;
use App\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function indexUsers(): User
    {
        return $this->userRepostory->getAllUsers();
    }

    public function getUser(int $id): User
    {
        return $this->userRepository->getUserById($id);
    }

    public function updateUser(int $id, array $payload): User
    {
        $user = $this->userRepository->getUserById($id);
        $user->name = $payload['name'];
        $user->profile = $payload['profile'];

        if (!empty($_FILES['file']['name'])) {
            $old_img_name = $user->img_name;
            if (!is_null($old_img_name) && file_exists("img/profile/{$old_img_name}")) {
                unlink("img/profile/{$old_img_name}");
            }

            $user->img_name = !empty($_FILES['file']['name']) ? $_FILES['file']['name'] : null;

            $fileDir = "img/profile";
            $tmp = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];

            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                move_uploaded_file($tmp, "{$fileDir}/{$name}");
            }
        }

        $user->save();
        return $user;
    }

    public function deleteUser(int $id): void
    {
        User::findOrFail($id)->delete();
    }
}