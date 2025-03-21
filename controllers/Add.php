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

        $row = [];

        if ($id) {
            $row = Connection::query('select * from cats where id = ' . (int)$id)->fetch_assoc();
        } else {
            $fathersList = Cats::getFatherOptions();
        }

        $list = Cats::getMotherOptions((int)$id);

        require 'views/cats_add.php';
    }
}
