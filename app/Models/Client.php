<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'state',
        'zipcode'
    ];
    
    public function user() {
        
        // um para um
        return $this->hasOne(User::class);
    }
}
