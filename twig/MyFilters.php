<?php

namespace KitSoft\Plenary\Twig;


class MyFilters {

    /**
     * @param $string
     * @return string
     */
    public static function StrToUpper($string): string
    {
        return mb_strtoupper($string);
    }

}
