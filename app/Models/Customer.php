<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
        'img_profile'
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
