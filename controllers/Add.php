<?php

namespace controllers;

use lib\Cats;
use lib\Connection;

class Add {

    public static function index($id = 0) {
        if ($_POST) { 
            Connection::insert('cats', $_POST);

            if (!$id) {
                $id = Connection::insertId();
            }

            header('location: /' . (int)$id);

            return;
        }

        $row = [
            'name' => '',
            'age' => 1,
            'mother_id' => ''
        ];

        $femaleChecked = 'checked';

        if ($id) {
            $row = Connection::query('select * from cats where id = ' . (int)$id)->fetch_assoc();

            if (!$row['female']) {
                $femaleChecked = '';
            }
        }

        $list = Cats::getOptions([(int)$id]);

        require 'views/cats_add.php';
    }
}
