<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Merchant extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'company_name',
        'address',
        'contact',
        'description',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
