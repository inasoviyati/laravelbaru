<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;
    
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class, 'meet_id', 'id');
    }
}
