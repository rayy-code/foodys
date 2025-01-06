<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    //
    protected $fillable = [
        "name",
        "description",
        "slug",
    ];

    public function menu():HasMany
    {
        return $this->hasMany(MenuItem::class,"category_id","id");
    }
}
