<?php

namespace controllers;

use lib\Cats;
use lib\Connection;

class Add {

    public static function index($id = 0) {
        if ($_POST) { 
            Connection::insert('cats', $_POST['row']);

            if (!$id) {
                $id = Connection::insertId();
            }

            if ($_POST['father']['id']) {
                $_POST['father']['cat_id'] = $id;
                
                Connection::insert('cats_fathers', $_POST['father']);
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

        $list = Cats::getMotherOptions((int)$id);

        if (!$id) {
            $fathersList = Cats::getFatherOptions();
        }

        require 'views/cats_add.php';
    }
}
