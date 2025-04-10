<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaultReport extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'report_id';
    protected $fillable = [
        'user_id', 
        'description', 
        'category', 
        'image', 
        'status',
        'validated',
        'validated_at',
        'validated_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'report_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
