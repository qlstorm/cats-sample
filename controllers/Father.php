<?php

namespace controllers;

use lib\Cats;

class Father {

    public static function add($param = 0) {
        Cats::addFather($_POST, $param);
    }
}
