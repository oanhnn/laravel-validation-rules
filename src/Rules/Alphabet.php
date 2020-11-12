<?php

namespace Laravel\Validation\Rules;

use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\Rule;
use function join;
use function preg_match;

final class Alphabet extends Rule
{
    /**
     * Allow numeric?
     *
     * @var bool
     */
    private $numeric = false;

    /**
     * Allow dash?
     *
     * @var bool
     */
    private $dash = false;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $pattern = $this->buildPattern();

        return (bool) preg_match($pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('validation.alphabet');
    }

    /**
     * Allow using numeric
     *
     * @param  bool $allow
     * @return self
     */
    public function allowNumeric(bool $allow = true): self
    {
        $this->numeric = $allow;

        return $this;
    }

    /**
     * Allow using "-" và "_"
     *
     * @param  bool $allow
     * @return self
     */
    public function allowDash(bool $allow = true): self
    {
        $this->dash = $allow;

        return $this;
    }

    /**
     * Build pattern
     *
     * @return string
     */
    private function buildPattern(): string
    {
        $allow = ['A-Z', 'a-z'];

        if ($this->numeric) {
            $allow[] = '\d';
        }

        if ($this->dash) {
            $allow[] = '_-';
        }

        return '/^[' + join('', $allow) + ']+$/';
    }
}
