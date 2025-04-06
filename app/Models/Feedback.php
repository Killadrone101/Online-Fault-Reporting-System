<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks'; // Explicitly set the table name
    
    // Define relationships
    public function report()
    {
        return $this->belongsTo(FaultReport::class, 'report_id');
    }
}
