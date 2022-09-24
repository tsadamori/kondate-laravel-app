<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Menu;
use App\Category1;
use App\Category2;
use App\Kondate;
use App\Services\MenuService;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;

class MenuController extends Controller
{
    private $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        return view('menus.index', $this->menuService->indexMenus());
    }

    public function show(int $id)
    {
        return view('menus.show', $this->menuService->getMenu($id));
    }

    public function create()
    {
        $menu = new Menu;
        
        return view('menus.create', [
            'menu' => $menu,
        ]);
    }

    public function store(StoreMenuRequest $request)
    {
        $menu = $this->menuService->storeMenu([
            'name' => $request->name ?? null,
            'content' => $request->content ?? null,
            'img_name' => $request->img_name ?? null,
            'ingredients' => $request->ingredients ?? null,
            'ingredients_count' => $request->ingredients_count ?? null,
            'category1_id' => $request->category1_id ?? null,
            'category2_id' => $request->category2_id ?? null,
            'outside_link' => $request->outside_link ?? null,
        ]);
        return redirect('/');
    }

    public function edit(int $id)
    {
         return view('menus.edit',  $this->menuService->editMenu($id));
    }

    public function update(UpdateMenuRequest $request, int $id)
    {
        $this->menuService->updateMenu($id, [
            'name' => $request->name,
            'content' => $request->content ?? null,
            'ingredients' => $request->ingredients ?? null,
            'ingredients_count' => $request->ingredients_count ?? null,
            'category1_id' => $request->category1_id ??  null,
            'category2_id' => $request->category2_id ??  null,
            'outside_link' => $request->outside_link ?? null,
        ]);
        return redirect('/');
    }

    public function destroy($id)
    {
        $menu = Menu::where('user_id', Auth::id())->find($id);
        $menu->delete_flg = 1;
        $menu->save();

        // サーバ上のサムネイル画像を削除
        $img_name = $menu->img_name;
        if (!is_null($img_name) && file_exists("img/upload/{$img_name}")) {
            unlink("img/upload/{$img_name}");
        }

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
