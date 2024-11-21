<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'merchant_id',
    ];

    // Relasi dengan User sebagai merchant
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id')->where('role', 'merchant');
    }

    // Relasi dengan order (opsional, jika diperlukan)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
