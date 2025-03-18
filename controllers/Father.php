<?php

namespace controllers;

use lib\Cats;

class Father {

    public static function add($catId = 0) {
        Cats::addFather($_POST, (int)$catId);
    }
}
