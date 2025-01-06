<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    //
    protected $fillable = [
        'user_id',
        'menu_id',
        'quantity'
    ];

    public function menu():BelongsTo
    {
        return $this->belongsTo(MenuItem::class,'menu_id','id');
    }
}
