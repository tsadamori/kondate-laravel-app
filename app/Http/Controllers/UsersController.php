<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Services\UserService;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(UserService $userService)
    {
        return view('users.index', [
            'users' => $userService->getUsers(),
        ]);
    }

    public function show(UserService $userService)
    {
        return view('users.show', [
            'user' => $userService->getUser(Auth::id()),
        ]);
    }

    public function edit(UserService $userService)
    {
        return view('users.edit', [
            'user' => $userService->getUser(Auth::id()),
        ]);
    }

    public function update(UpdateUserRequest $request, UserService $userService)
    {
        $userService->updateUser(Auth::id(), [
            'name' => $request->name,
            'profile' => $request->profile
        ]);

        return redirect('profile');
    }

    public function delete(UserService $userService)
    {
        $userService->deleteUser($id);
        Auth::logout();

        return view('users.bye');
    }
}
