<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get type that is assosiated with a user.
     */
    public function userLogs()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
