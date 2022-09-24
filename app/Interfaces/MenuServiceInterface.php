<?php

namespace App\Interfaces;

use App\Menu;

interface MenuServiceInterface
{
    public function indexMenus(): array;
    public function getMenu(int $id): array;
    public function storeMenu(array $payload): Menu;
    public function editMenu(int $id): array;
    public function updateMenu(int $id, array $payload): Menu;
    public function destoryMenu(int $id): void;
}