<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Ramsey\Uuid\Type\Integer;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get all of the roomUsers for the Room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roomUsers(): HasMany
    {
        return $this->hasMany(RoomUser::class);
    }
}
