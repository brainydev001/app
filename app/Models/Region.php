<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get user who created this region.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
