<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_name',
        'total_price',
        'order_date',
    ];

    /**
     * Get the order items associated with the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
