<?php

namespace App\Policies;

use App\Models\Merchant;
use App\Models\Menu;

class MenuPolicy
{
    public function update(Merchant $merchant, Menu $menu)
    {
        return $menu->merchant_id === $merchant->id; // Hanya merchant pemilik menu
    }

    public function delete(Merchant $merchant, Menu $menu)
    {
        return $menu->merchant_id === $merchant->id; // Hanya merchant pemilik menu
    }
}
