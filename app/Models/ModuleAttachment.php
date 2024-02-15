<?php

namespace App\Models;

use App\Models\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModuleAttachment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    /**
     * Get the module that owns the ModuleAttachment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
