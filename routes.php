<?php

use KitSoft\Plenary\Classes\TimeSite;
use Carbon\Carbon;

Route::get('/time', function () {

    $time = TimeSite::instance()->getTime();

    dump($time);

    sleep(10);

    dump($time);
});
