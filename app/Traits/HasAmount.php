<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasAmount
{
    use NumberFormat;

    /**
     * The amount number accessor and mutator.
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->get($value),
            set: fn (mixed $value) => $this->set($value),
        );
    }
}
