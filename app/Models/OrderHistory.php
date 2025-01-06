<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    //
    protected $table = "order_histories";
    protected $fillable = [
        "order_id",
        "menu_item_id",
        "quantity",
        "price"
    ];
}
