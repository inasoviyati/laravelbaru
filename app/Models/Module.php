<?php

namespace App\Models;

use App\Models\ModuleAttachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function meet(): BelongsTo
    {
        return $this->belongsTo(Meet::class);
    }

    public function moduleAttachments(): HasMany
    {
        return $this->hasMany(ModuleAttachment::class);
    }
}
