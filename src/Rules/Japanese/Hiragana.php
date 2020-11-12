<?php

namespace Laravel\Validation\Rules\Japanese;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

use function preg_match;
use function tap;

final class Hiragana implements Rule
{
    /**
     * Regex pattern for check
     */
    protected const PATTERN = [
        'hiragana' => '/^[ぁ-んー]+$/u',
        'space' => '/^[ 　]+$/u',
        'hiragana+space' => '/^[ぁ-んー 　]+$/u',
    ];

    /**
     * Allow space flag
     *
     * @var bool
     */
    protected $allowedSpace = false;

    /**
     * Make rule instacne with allow space
     *
     * @return self
     */
    public static function andSpace(): self
    {
        return tap(new self(), function ($rule) {
            $rule->allowedSpace = true;
        });
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // If space wasn't allowed
        if (!$this->allowedSpace) {
            return (bool) preg_match(self::PATTERN['hiragana'], $value);
        }

        // If value is only space
        if (preg_match(self::PATTERN['space'], $value)) {
            return false;
        }

        return (bool) preg_match(self::PATTERN['hiragana+space'], $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|null
     */
    public function message(): ?string
    {
        return Lang::get('validation-rules::message.japanese.hiragana');
    }
}
