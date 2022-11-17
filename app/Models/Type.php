<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory; 
    
    // mass assignment to table
    public $guarded = [];

    /**
     * Get user who created this type.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get type that is assosiated with a user.
     */
    public function userType()
    {
        return $this->belongsTo(User::class, 'type_id');
    }
    
}
