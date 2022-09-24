<?php

namespace App\Services;

use App\Menu;
use App\Kondate;
use App\Repositories\MenuRepository;
use App\Interfaces\MenuServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MenuService implements MenuServiceInterface
{
    private $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function indexMenus(): array
    {
        $user = Auth::user();
        $menus = $this->menuRepository->getAllMenus(Auth::id());
        $kondate = new Kondate;

        // ユーザ名をセッションに保存
        Session::put('user_name', $user->name);

        foreach($menus as $menu) {
            $menu->category1_mod = isset($menu->category1->category1) ? $menu->category1->category1 : 'なし';
            $menu->category2_mod = isset($menu->category2->category2) ? $menu->category2->category2 : 'なし';
        }

        return [
            'menus' => $menus,
            'kondate' => $kondate,
        ];
    }

    public function getMenu(int $id): array
    {
        $menu = $this->menuRepository->getMenu($id, ['user_id' => Auth::id()]);

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

        return [
            'menus' => $menus,
            'ingredients' => $ingredients,
        ];
    }

    public function storeMenu(array $payload): Menu
    {
        $ingredients = $payload['ingredients'];
        $ingredients_count = $payload['ingredients_count'];
        $ingredients_array = [];

        for ($i = 0; $i < count($ingredients); $i++) {
            array_push($ingredients_array, !is_null($ingredients[$i]) ? $ingredients[$i] : '');
            array_push($ingredients_array, !is_null($ingredients_count[$i]) ? $ingredients_count[$i] : '');
        }

        $insert_ingredients = implode(',', $ingredients_array);

        $menu = $this->menuRepository->storeMenu([
            'name' => $payload['name'],
            'user_id' => Auth::id(),
            'content' => !empty($payload['content']) ? $payload['content'] : null,
            'img_name' => !empty($_FILES['file']['name']) ? $_FILES['file']['name'] : null,
            'ingredients' => $insert_ingredients,
            'category1_id' => !empty($payload['category1_id']) ? $payload['category1_id'] : null,
            'category2_id' => !empty($payload['category2_id']) ? $payload['category2_id'] : null,
            'outside_link' => !empty($payload['outside_link']) ? $payload['outside_link'] : null,
        ]);

        //画像アップロード
        $fileDir = "img/upload";
        $tmp = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            move_uploaded_file($tmp, "{$fileDir}/{$name}");
        }

        return $menu;
    }

    public function editMenu(int $id): array
    {
        $menu = $this->menuRepository->getMenu($id, ['user_id' => Auth::id()]);
        $tmp_array = explode(',', $menu->ingredients);

        $ingredients = [];

        for($i = 0; $i < count($tmp_array) / 2; $i++) {
            $ingredients[$i]['ingredient'] = $tmp_array[$i * 2];
            $ingredients[$i]['count'] = $tmp_array[$i * 2 + 1];
        }

        return [
            'menu' => $menu,
            'ingredients' => $ingredients,
        ];
    }

    public function updateMenu(int $id, array $payload): Menu
    {
        $ingredients = $payload['ingredients'];
        $ingredients_count = $payload['ingredients_count'];
        $ingredients_array = [];

        for ($i = 0; $i < count($ingredients); $i++) {
            array_push($ingredients_array, !is_null($ingredients[$i]) ? $ingredients[$i] : '');
            array_push($ingredients_array, !is_null($ingredients_count[$i]) ? $ingredients_count[$i] : '');
        }

        $insert_ingredients = implode(',', $ingredients_array);
        $imgName = '';

        if (!empty($_FILES['file']['name'])) {
            // 変更前の古い画像を削除
            $old_img_name = $menu->img_name;
            if (!is_null($old_img_name) && file_exists("img/upload/{$old_img_name}")) {
                unlink("img/upload/{$old_img_name}");
            }
            
            $imgName = $_FILES['file']['name'];

            //画像変更
            $fileDir = "img/upload";
            $tmp = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];
            
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                move_uploaded_file($tmp, "{$fileDir}/{$name}");
            }
        }
        
        $menu = $this->menuRepository->updateMenu($id, [
            'name' => $payload['name'],
            'content' => $payload['content'],
            'img_name' => $imgName,
            'ingredients' => $payload['ingredients'],
            'category1_id' => $payload['category1_id'],
            'category2_id' => $payload['category2_id'],
            'outside_link' => $payload['outside_link'],
        ]);
        return $menu;
    }

    public function destoryMenu(int $id): void
    {
        $menu = $this->menuRepository->deleteMenu($id, ['user_id' => Auth::id()]);
        
        // サーバ上のサムネイル画像を削除
        $img_name = $menu->img_name;
        if (!is_null($img_name) && file_exists("img/upload/{$img_name}")) {
            unlink("img/upload/{$img_name}");
        }
    }
}