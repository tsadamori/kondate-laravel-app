<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Services\UserService;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('users.index', [
            'users' => $this->userService->indexUsers(),
        ]);
    }

    public function show()
    {
        return view('users.show', [
            'user' => $this->userService->getUser(Auth::id()),
        ]);
    }

    public function edit()
    {
        return view('users.edit', [
            'user' => $this->userService->getUser(Auth::id()),
        ]);
    }

    public function update(UpdateUserRequest $request)
    {
        $this->userService->updateUser(Auth::id(), [
            'name' => $request->name,
            'profile' => $request->profile
        ]);

        return redirect('profile');
    }

    public function delete()
    {
        $this->userService->deleteUser($id);
        Auth::logout();

        return view('users.bye');
    }
}
