<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable=[
        'reg_no',
        'vms_code',
        'department_id',
        'allotee',
        'maker',
        'body_type',
        'vehicle_type',
        'model',
        'engine_power',
        'colour',
        'engine_no',
        'chassis_no',
        'type',
        'allotted_by',
        'purchase_type',
        'meter_reading',
        'fuel_average',
        'fuel_average',
        'fuel_average',
        'prev_reg_no',
        'status',
        'entitle'
    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }
}
