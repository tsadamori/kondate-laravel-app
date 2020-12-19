<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Menu;
use App\Category1;
use App\Category2;
use App\Kondate;

class MenusController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $menus = Menu::where('user_id', Auth::id())
                ->where('delete_flg', 0)
                ->orderBy('id', 'desc')
                ->paginate(10);
            $kondate = new Kondate;
    
            // ユーザ名をセッションに保存
            Session::put('user_name', $user->name);
    
            foreach($menus as $menu) {
                $menu->category1_mod = isset($menu->category1->category1) ? $menu->category1->category1 : 'なし';
                $menu->category2_mod = isset($menu->category2->category2) ? $menu->category2->category2 : 'なし';
            }
    
            $data = [
                'menus' => $menus,
                'kondate' => $kondate,
            ];
    
            return view('menus.index', $data);
        } else {
            return view('welcome');
        }
    }

    public function show($id)
    {
        $menu = Menu::where('user_id', Auth::id())->find($id);

        //材料を配列に格納
        $tmp_array = explode(',', $menu->ingredients);

        $ingredients = [];

        for($i = 0; $i < count($tmp_array) / 2; $i++) {
            $ingredients[$i]['ingredient'] = $tmp_array[$i * 2];
            $ingredients[$i]['count'] = $tmp_array[$i * 2 + 1];
        }

        //カテゴリの指定がない場合「なし」を表示
        $menu->category1_mod = isset($menu->category1->category1) ? $menu->category1->category1 : 'なし';
        $menu->category2_mod = isset($menu->category2->category2) ? $menu->category2->category2 : 'なし';

        return view('menus.show', [
            'menu' => $menu,
            'ingredients' => $ingredients,
        ]);
    }

    public function create()
    {
        $menu = new Menu;
        
        return view('menus.create', [
            'menu' => $menu,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'content' => 'max:191',
        ]);

        $ingredients = $request->ingredients;
        $ingredients_count = $request->ingredients_count;
        $ingredients_array = [];

        for ($i = 0; $i < count($ingredients); $i++) {
            array_push($ingredients_array, !is_null($ingredients[$i]) ? $ingredients[$i] : '');
            array_push($ingredients_array, !is_null($ingredients_count[$i]) ? $ingredients_count[$i] : '');
        }

        $insert_ingredients = implode(',', $ingredients_array);

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->user_id = Auth::id();
        $menu->content = !empty($request->content) ? $request->content : null;
        $menu->img_name = !empty($_FILES['file']['name']) ? $_FILES['file']['name'] : null;
        $menu->ingredients = $insert_ingredients;
        $menu->category1_id = !empty($request->category1_id) ? $request->category1_id : null;
        $menu->category2_id = !empty($request->category2_id) ? $request->category2_id : null;
        $menu->outside_link = !empty($request->outside_link) ? $request->outside_link: null;
        $menu->save();

        //画像アップロード
        $fileDir = "img";
        $tmp = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            move_uploaded_file($tmp, "$fileDir/$name");
        }

        return redirect('/');
    }

    public function edit($id)
    {
        $menu = Menu::where('user_id', Auth::id())->find($id);
        $tmp_array = explode(',', $menu->ingredients);

        $ingredients = [];

        for($i = 0; $i < count($tmp_array) / 2; $i++) {
            $ingredients[$i]['ingredient'] = $tmp_array[$i * 2];
            $ingredients[$i]['count'] = $tmp_array[$i * 2 + 1];
        }

        return view('menus.edit', [
            'menu' => $menu,
            'ingredients' => $ingredients,
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'content' => 'max:191',
        ]);
        
        $ingredients = $request->ingredients;
        $ingredients_count = $request->ingredients_count;
        $ingredients_array = [];

        for ($i = 0; $i < count($ingredients); $i++) {
            array_push($ingredients_array, !is_null($ingredients[$i]) ? $ingredients[$i] : '');
            array_push($ingredients_array, !is_null($ingredients_count[$i]) ? $ingredients_count[$i] : '');
        }

        $insert_ingredients = implode(',', $ingredients_array);

        $menu = Menu::where('user_id', Auth::id())->find($id);
        $menu->name = $request->name;
        $menu->content = !empty($request->content) ? $request->content : null;
        $menu->ingredients = $insert_ingredients;
        $menu->category1_id = !empty($request->category1_id) ? $request->category1_id : null;
        $menu->category2_id = !empty($request->category2_id) ? $request->category2_id : null;
        $menu->outside_link = !empty($request->outside_link) ? $request->outside_link: null;
        $menu->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        $menu = Menu::where('user_id', Auth::id())->find($id);
        $menu->delete_flg = 1;
        $menu->save();

        return redirect('/');
    }

    public function search(Request $request)
    {
        if(!empty($request->category1_id) && !empty($request->category2_id)) {
            $menus = Menu::where('name', 'like', "%{$request->keyword}%")
                // ->orWhere('content', 'like', "%{$request->keyword}%")
                ->where('user_id', Auth::id())
                ->where('category1_id', $request->category1_id)
                ->where('category2_id', $request->category2_id)
                ->where('delete_flg', 0)
                ->orderBy('id', 'desc')
                ->get();
        } else if(empty($request->category1_id) && !empty($request->category2_id)) {
            $menus = Menu::where('name', 'like', "%{$request->keyword}%")
            // ->orWhere('content', 'like', "%{$request->keyword}%")
                ->where('user_id', Auth::id())
                ->where('category2_id', $request->category2_id)
                ->where('delete_flg', 0)
                ->orderBy('id', 'desc')
                ->get();
        } else if(!empty($request->category1_id) && empty($request->category2_id)) {
            $menus = Menu::where('name', 'like', "%{$request->keyword}%")
            // ->orWhere('content', 'like', "%{$request->keyword}%")
                ->where('user_id', Auth::id())
                ->where('category1_id', $request->category1_id)
                ->where('delete_flg', 0)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $menus = Menu::where('name', 'like', "%{$request->keyword}%")
            // ->orWhere('content', 'like', "%{$request->keyword}%")
                ->where('user_id', Auth::id())
                ->orderBy('id', 'desc')
                ->where('delete_flg', 0)
                ->get();
        }

        foreach($menus as $menu) {
            $menu->category1_mod = isset($menu->category1->category1) ? $menu->category1->category1 : 'なし';
            $menu->category2_mod = isset($menu->category2->category2) ? $menu->category2->category2 : 'なし';
        }

        return response()->json($menus);
    }

    public function add_kondate(Request $request) {
        // $_SESSION['menu_id'] = array_push($_SESSION['menu_id'], $request->id);
        // $_SESSION['menu_id'][] = $request->id;
        $request->session()->push('menu_id', $request->id);
        // Session::Push('menu_id', array(1, 2, 3));
        // echo json_encode($request->session()->all());
        echo json_encode(Session::all());
        // echo json_encode(Session::getId());
        // echo json_encode($request->session()->all());
    }
}
