<?php

Event::listen('kitsoft.plenary::category.public', function (&$title, &$published) {
    $title = strtoupper($title) . '- category';
    $published = true;
}, 12);

Event::listen('kitsoft.plenary::test', function () {
   echo "for test";
});

