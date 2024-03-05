<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['diffTime'];

    protected $casts = [
        'time_start' => 'datetime:H:i',
        'time_end' => 'datetime:H:i',
    ];

    public $timestamps = false;

    public function timeFormated($time)
    {
        return date('H:i', strtotime($this->$time));
    }

    public function getDiffTimeAttribute()
    {
        $time_start = Carbon::parse($this->attributes['time_start']);
        $time_end = Carbon::parse($this->attributes['time_end']);
        return $time_start->diff($time_end)->format('%h Jam %i Menit');
    }
}
