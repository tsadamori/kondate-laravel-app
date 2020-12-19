<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追加
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function show()
    {
        $user = User::find(Auth::id());

        return view('users.show', [
            'user' => $user,
        ]);
    }

    public function delete()
    {
        $user = User::where('id', Auth::id());
        $user->delete();
        Auth::logout();

        return view('users.bye');
    }
}
