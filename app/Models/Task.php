<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'description', 'assigned_to', 'due_datetime', 'status'];

    protected $casts = [
        'due_datetime' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    public static function getStatusOptions(): array
    {
        return ['pending', 'in progress', 'completed', 'overdue'];
    }
}
