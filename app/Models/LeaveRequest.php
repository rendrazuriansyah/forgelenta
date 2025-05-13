<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id',
        'leave_type',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function getLeaveType()
    {
        return [
            'Sick Leave',
            'Vacation',
            'Personal Leave',
            'Maternity Leave',
            'Paternity Leave'
        ];
    }

    public static function getStatus()
    {
        return [
            'pending',
            'approved',
            'rejected',
            'cancelled'
        ];
    }
}
