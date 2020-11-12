<?php

namespace Laravel\Validation\Rules\Japanese;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

use function mb_convert_kana;
use function preg_match;

final class PostalCode implements Rule
{
    use FormatCharacterTrait;

    protected const PATTERN = '/^\d{3}\-?\d{4}$/';

    /**
     * Validate postal code
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // 全角数字を半角へ変換
        $text = mb_convert_kana($value, 'asK', 'UTF-8');

        // ハイフンを半角へ変換
        $text = $this->formatHyphen($text);

        return (bool) preg_match(self::PATTERN, $text);
    }

    /**
     * Get the validation error message.
     *
     * @return string|null
     */
    public function message(): ?string
    {
        return Lang::get('validation.postal_code');
    }
}
