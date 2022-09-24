<?php

namespace App\Interfaces;

use App\Menu;

interface MenuRepositoryInterface
{
    public function getAllMenus(int $userId);
    public function getMenu(int $id, array $where = null);
    public function storeMenu(array $payload): Menu;
    public function updateMenu(int $id, array $payload): Menu;
    public function deleteMenu(int $id, array $where = null): void;
}