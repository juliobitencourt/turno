<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAmount
{
    /**
     * The amount number accessor and mutator.
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => number_format($value / 100, 2, '.', ''),
            set: fn (mixed $value) => $value * 100,
        );
    }
}
