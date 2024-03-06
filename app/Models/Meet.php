<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public $casts = [
        'date' => 'datetime:Y-m-d',
    ];

    /**
     * Get all of the assistances for the Meet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assistances(): HasMany
    {
        return $this->hasMany(Assistance::class);
    }

    /**
     * Get all of the scores for the Meet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    /**
     * Get all of the attendances for the Meet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the assignments that owns the Meet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    /**
     * Get all of the modules for the Assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }
}
