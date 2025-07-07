<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['dining_method', 'dining_table_id', 'total_price', 'payment_method', 'status'];

    public function table()
    {
        return $this->belongsTo(DiningTable::class, 'dining_table_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
