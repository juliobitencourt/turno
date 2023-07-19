<?php

namespace App\Traits;

trait NumberFormat
{
    /**
     * Get the formated number.
     */
    protected function get($value): string
    {
        return number_format($value / 100, 2, '.', '');
    }

    /**
     * Set the formated number.
     */
    public function set($value): int
    {
        return $value * 100;
    }
}
