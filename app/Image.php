<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['image_path', 'message_id'];
    
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
