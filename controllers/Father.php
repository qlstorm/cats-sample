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

        $res = Connection::query('select id from cats_fathers where cat_id = ' . (int)$catId)->fetch_all();

        $list = Cats::getFatherOptions($catId);

        require 'views/cats_add_father.php';
    }
}
