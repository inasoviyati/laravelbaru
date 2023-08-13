<?php

namespace App\Services;

trait HasDate
{
    protected function numberToDayName($number)
    {
        $days = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
        ];

        return $days[--$number];
    }
}
