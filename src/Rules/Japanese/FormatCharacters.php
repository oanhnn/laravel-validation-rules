<?php

namespace Laravel\Validation\Rules\Japanese;

use function array_keys;
use function array_values;
use function str_replace;

trait FormatCharacters
{
    /**
     * Formatting hyphen character
     *
     * @param  string $value
     * @return void
     */
    protected function formatHyphen(string $value): string
    {
        $table = [
            'ー' => '-',
            '−' => '-',
        ];
        $search = array_keys($table);
        $replace = array_values($table);

        return str_replace($search, $replace, $value);
    }
}
