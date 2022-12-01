<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get constituency for a event.
     */
    public function constituencies()
    {
        return $this->belongsTo(Region::class, 'constituency_id');
    }

    /**
     * Get region for a event.
     */
    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * Get ward for a event.
     */
    public function wards()
    {
        return $this->belongsTo(Region::class, 'ward_id');
    }

    /**
     * Get team leader for a event.
     */
    public function leaders()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Get budget for a event.
     */
    public function eventBudget()
    {
        return $this->belongsTo(Budget::class, 'event_id');
    }

    /**
     * Get user who created this event.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');  
    }
}
