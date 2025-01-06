<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = "order_details";
    protected $fillable = [
        "order_id",
        "menu_item_id",
        "quantity",
        "price"
    ];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function menuItem(){
        return $this->belongsTo(MenuItem::class,'menu_item_id');
    }
}
