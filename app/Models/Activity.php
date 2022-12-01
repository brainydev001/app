<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // mass assignment to table
    public $guarded = [];

    /**
     * Get region for a activity.
     */
    public function regions()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * Get ward for a activity.
     */
    public function wards()
    {
        return $this->belongsTo(Region::class, 'ward_id');
    }

    /**
     * Get team leader for a activity.
     */
    public function leaders()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Get constituency for a event.
     */
    public function constituencies()
    {
        return $this->belongsTo(Region::class, 'constituency_id');
    }

    /**
     * Get budget for a activity.
     */
    public function activityBudget()
    {
        return $this->belongsTo(Budget::class, 'activity_id');
    }

    /**
     * Get user who created this activity.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');  
    }
}
