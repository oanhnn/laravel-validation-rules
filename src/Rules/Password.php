<?php

namespace Laravel\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;
use function preg_match;

class Password implements Rule
{
    /**
     * Pattern for Password Strength Validation with Regular Expressions
     *
     * @see https://www.zorched.net/2009/05/08/password-strength-validation-with-regular-expressions/
     */
    protected const PATTERN = '/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*[!@#$%^&"*()\-_=+{};:,<.>a-zA-Z\d]+$/';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return preg_match(static::PATTERN, $value) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string|null
     */
    public function message(): ?string
    {
        return Lang::get('validation-rules::message.password');
    }
}
