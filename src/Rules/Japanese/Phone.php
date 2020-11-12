<?php

namespace Laravel\Validation\Rules\Japanese;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

use function mb_convert_kana;
use function preg_match;

final class Phone implements Rule
{
    use FormatCharacters;

    protected const PATTERN = '/^[\d]{2,5}-?[\d]{1,4}-?[\d]{3,4}$/';

    /**
     * Validation phone number
     *
     * @param  string $attribute
     * @param  string $value
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
     * @return string
     */
    public function message()
    {
        return Lang::get('validation-rules::message.phone');
    }
}
