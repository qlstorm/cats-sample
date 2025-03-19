<?php

namespace controllers;

use lib\Cats;
use lib\Connection;

class Father {

    public static function add($catId = 0) {
        if ($_POST) {
            $_POST['cat_id'] = $catId;

            Connection::insert('cats_fathers', $_POST);

            header('location: /' . (int)$catId);

            return;
        }

        $list = Cats::getFatherOptions($catId);

        require 'views/cats_add_father.php';
    }
}
