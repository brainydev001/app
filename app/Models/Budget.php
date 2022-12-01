<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get user who created this budget.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');  
    }
}
