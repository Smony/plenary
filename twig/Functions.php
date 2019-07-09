<?php

namespace KitSoft\Plenary\Twig;

use Kitsoft\Plenary\Models\Category;

class Functions {

    /**
     * @return mixed
     */
    public static function category()
    {
        return Category::where('published', true)->get();
    }

}
