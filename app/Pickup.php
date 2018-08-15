<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    protected $fillable = ['grid_no', 'grid_size', 'user_id', 'message_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
