<?php

namespace Laravel\Validation\Rules;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

use function class_basename;

final class Authorized implements Rule
{
    /**
     * @var string
     */
    protected $ability;

    /**
     * @var array
     */
    protected $arguments;

    /**
     * @var string
     */
    protected $modelClassName;

    /**
     * @var Authorizable
     */
    protected $user;

    /**
     * Create a new rule instance.
     *
     * @param  Authorizable $user
     * @param  string       $ability
     * @param  string       $modelClassName
     * @return void
     */
    public function __construct(Authorizable $user, string $ability, string $modelClassName)
    {
        $this->user = $user;
        $this->ability = $ability;
        $this->modelClassName = $modelClassName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!$model = $this->modelClassName::find($value)) {
            return false;
        }

        return $this->user->can($this->ability, $model);
    }

    /**
     * Get the validation error message.
     *
     * @return string|null
     */
    public function message(): ?string
    {
        $classBasename = class_basename($this->modelClassName);

        return Lang::get('validation-rules::messages.authorized', [
            'model' => $classBasename,
        ]);
    }
}
