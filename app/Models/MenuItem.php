<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MenuItem extends Model
{
    //
    protected $fillable = [
        "name",
        "description",
        "price",
        "image",
        "category_id",
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Category::class,"category_id","id");
    }

    public function cart():HasOne
    {
        return $this->hasOne(Cart::class,"menu_id","id");
    }
}
