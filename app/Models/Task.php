<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
        'priority',
        'assigned_to',
        'assigned_by',
        'progress_percent',
        'daily_update',
        'todo_work',
        'pending_work',
        'start_date',
        'due_date',
        'completed_at',
        'created_by',
        'updated_by',
    ];

    protected $appends = [
        'assigned_to_name',
        'assigned_by_name',
    ];

    // Manager who assigned the task
    public function getUsergetUsername()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'id');
    }

    // Developer / Assignee
    public function getUserUsername()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }

    // Accessor for assigned developer name
    public function getAssignedToNameAttribute(): string
    {
        return $this->getUserUsername?->name ?? (string) ($this->assigned_to ?: 'Unassigned');
    }

    // Accessor for assigning manager name
    public function getAssignedByNameAttribute(): string
    {
        return $this->getUsergetUsername?->name ?? (string) ($this->assigned_by ?: 'Manager');
    }
}
