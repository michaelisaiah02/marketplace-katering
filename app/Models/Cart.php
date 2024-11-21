<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Menu;

class Cart extends Model
{
    protected $fillable = [
        'customer_id',
        'menu_id',
        'quantity',
    ];

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
