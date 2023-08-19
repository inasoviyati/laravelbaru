<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class AssignmentStudent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = [];

    /**
     * Get the user that owns the AssignmentStudent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function roomStudent(): HasOneThrough
    {
        return $this->hasOneThrough(RoomUser::class, User::class, 'id', 'student_id', 'student_id', 'id');
    }
}
