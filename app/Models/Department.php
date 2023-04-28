<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable=[
      'dep_name',
      'focal_person',
      'phone',
      'short_code',
      'parent_id',
      'is_main_dep',
    ];

    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    public function subDepartments()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

    public function users(){
        return $this->hasOne(User::class, 'id');
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class, 'department_id');
    }
}

