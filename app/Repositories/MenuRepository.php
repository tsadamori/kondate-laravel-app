<?php

namespace App\Repositories;

use App\Menu;
use App\Interfaces\MenuRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class MenuRepository implements MenuRepositoryInterface
{
    public function getAllMenus(int $userId)
    {
        return Menu::where('user_id', $userId)
            ->where('delete_flg', 0)
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function getMenu(int $id, array $where = null)
    {
        return Menu::when($where, function ($query) use ($where) {
            return $query->where($where);
        })->findOrFail($id);
    }

    public function storeMenu(array $payload): Menu
    {
        $menu = new Menu;
        $menu->name = $payload['name'];
        $menu->user_id = $payload['user_id'];
        $menu->content = $payload['content'];
        $menu->img_name = $payload['img_name'];
        $menu->ingredients = $payload['ingredients'];
        $menu->category1_id = $payload['category1_id'];
        $menu->category2_id = $payload['category2_id'];
        $menu->outside_link = $payload['outside_link'];
        $menu->save();
        return $menu;
    }

    public function updateMenu(int $id, array $payload): Menu
    {
        $menu = Menu::where('user_id', Auth::id())->find($id);
        $menu->name = $payload['name'];
        $menu->content = $payload['content'];
        $menu->ingredients = $payload['ingredients'];
        $menu->category1_id = $payload['category1_id'];
        $menu->category2_id = $payload['category2_id'];
        $menu->outside_link = $payload['outside_link'];
        $menu->img_name = $payload['img_name'];
        $menu->save();
        return $menu;
    }

    public function deleteMenu(int $id, array $where = null): void
    {
        $menu = Menu::when($where, function($query) use($where) {
            return $query->where($where);
        })
        ->findOrFail($id);

        $menu->delete_flg = 1;
        $menu->save();
    }
}