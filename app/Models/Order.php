<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'merchant_id',
        'status',
        'total_price',
        'delivery_date',
    ];

    // Relasi dengan User sebagai customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    // Relasi dengan User sebagai merchant
    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    // Relasi dengan OrderItem
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabel()
    {
        switch ($this->status) {
            case 'pending':
                return 'Menunggu Konfirmasi';
            case 'confirmed':
                return 'Dikonfirmasi';
            case 'in_progress':
                return 'Sedang Diproses';
            case 'completed':
                return 'Selesai';
            case 'cancelled':
                return 'Dibatalkan';
            default:
                return 'Tidak Diketahui';
        }
    }
}
