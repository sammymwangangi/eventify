<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'location', 'start_at', 'end_at', 'description', 'user_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
