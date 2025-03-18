<?php

namespace controllers;

use lib\Cats;

class Add {

    public static function index($id = 0) {
        Cats::add($_POST, (int)$id);
    }
}
