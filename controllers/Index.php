<?php

namespace controllers;

use lib\Cats;
use SplFixedArray;

class Index {

    public static function index($id = 0) {
        if ($id && is_numeric($id)) {
            return Cats::view((int)$id);
        }

        $list = Cats::getList();

        if (!isset($_GET['age'])) {
            $_GET['age'] = '';
        }

        $femaleSelect = ['', ''];

        if (isset($_GET['female']) && strlen($_GET['female'])) {
            $femaleSelect[(int)$_GET['female']] = 'selected';
        }

        require 'views/cats.php';
    }

    public static function delete($id = 0) {
        Cats::delete($id);
    }

    public static function deleteFather($id = 0, $parentId = 0) {
        Cats::deleteFather($id, $parentId);
    }
}
