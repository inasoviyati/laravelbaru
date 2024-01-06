<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Module extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function meet(): BelongsTo
    {
        return $this->belongsTo(Meet::class);
    }
}
