<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['dayLocale', 'diffTime'];

    public $timestamps = false;

    public function getDiffTimeAttribute()
    {
        $time_start = Carbon::parse($this->attributes['time_start']);
        $time_end = Carbon::parse($this->attributes['time_end']);
        return $time_start->diff($time_end)->format('%h Jam %i Menit');
    }

    public function getDayLocaleAttribute()
    {
        $day = $this->attributes['day'] - 1;
        $alias = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        return $alias[$day];
    }
}
