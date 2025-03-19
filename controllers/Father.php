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

        $row = Connection::query('select mother_id from cats where id = ' . (int)$catId)->fetch_assoc();

        $res = Connection::query('select id from cats_fathers where cat_id = ' . (int)$catId)->fetch_all();

        $noIdList = array_column($res, 0);

        $noIdList[] = (int)$catId;

        if ($row['mother_id']) {
            $noIdList[] = $row['mother_id'];
        }

        $list = Cats::getOptions($noIdList);

        require 'views/cats_add_father.php';
    }
}
