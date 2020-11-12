<?php

namespace Laravel\Validation\Rules;

use DateTimeZone;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

use function in_array;

class Timezone implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array($value, DateTimeZone::listIdentifiers());
    }

    /**
     * Get the validation error message.
     *
     * @return string|null
     */
    public function message(): ?string
    {
        return Lang::get('validation-rules::message.timezone');
    }
}
