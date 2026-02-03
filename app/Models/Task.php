<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'is_complete',
        'due_date',
        'priority',
        'category',
        'tags',
        'estimated_minutes',
        'reminder_at',
    ];

    /**
     * Cast attributes to specific types.
     */
    protected $casts = [
        'is_complete' => 'boolean',
        'due_date' => 'date',
        'reminder_at' => 'datetime',
    ];

    /**
     * Task owner relationship.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
