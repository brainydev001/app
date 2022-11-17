<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get kib for a user.
     */
    public function userKin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
