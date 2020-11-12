<?php

namespace Laravel\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use League\ISO3166\ISO3166;

class CountryCode implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        foreach ((new ISO3166())->iterator(ISO3166::KEY_ALPHA2) as $code) {
            if (strcasecmp($code, $value) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): ?string
    {
        return trans('validation.country_code');
    }
}
