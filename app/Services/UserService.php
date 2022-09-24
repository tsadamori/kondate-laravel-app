<?php

namespace App\Services;

use App\User;
use App\Repository\UserRepository;

class UserService implements UserServiceInterface
{

    public function getUsers(): User
    {
        return User::paginate(10);
    }

    public function getUser(int $id): User
    {
        return User::findOrFail($id);
    }

    public function updateUser(int $id, array $payload): User
    {
        $user = User::findOrFail($id);
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