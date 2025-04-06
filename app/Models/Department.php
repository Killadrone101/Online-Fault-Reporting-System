<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'department_id';
    protected $fillable = ['name', 'staff_id'];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function reports()
    {
        return $this->hasManyThrough(
            FaultReport::class,
            User::class,
            'staff_id',  // Foreign key on users table (since departments.staff_id = users.id)
            'user_id',   // Foreign key on fault_reports table
            'staff_id',  // Local key on departments table
            'id'        // Local key on users table
        );
    }

}
