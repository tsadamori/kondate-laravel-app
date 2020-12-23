<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
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

    public function edit()
    {
        $user = User::find(Auth::id());

        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        // バリデーション
        $this->validate($request, [
            'name' => 'required',
            'profile' => 'required',
        ]);

        // ユーザ情報をアップデート
        $user = User::where('id', Auth::id())->first();

        // 変更前の古い画像を削除
        $old_img_name = $user->img_name;

        if (!is_null($old_img_name) && file_exists("img/profile/{$old_img_name}")) {
            unlink("img/profile/{$old_img_name}");
        }

        $user->name = $request->name;
        $user->img_name = !empty($_FILES['file']['name']) ? $_FILES['file']['name'] : null;
        $user->profile = $request->profile;
        $user->save();

        // プロフィール画像アップロード
        $fileDir = "img/profile";
        $tmp = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            move_uploaded_file($tmp, "{$fileDir}/{$name}");
        }

        return redirect('profile');
    }

    public function delete()
    {
        $user = User::where('id', Auth::id());
        $user->delete();
        Auth::logout();

        return view('users.bye');
    }
}
