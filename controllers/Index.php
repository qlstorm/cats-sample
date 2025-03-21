<?php

namespace controllers;

use lib\Cats;
use lib\Connection;

class Index {

    public static function index($id = 0) {
        if ($id) {
            $_GET['id'] = $id;

            $list = Cats::getList();

            $row = $list[0];

            $_GET = [
                'child' => $id
            ];

            $fathers = Cats::getList();

            require 'views/cats_view.php';

            return;
        }

        $list = Cats::getList();

        require 'views/cats.php';
    }

    public static function delete($id = 0) {
        $query = 'delete from cats where id = ' . (int)$id . ';';

        $query .= 'delete from cats_fathers where cat_id = ' . (int)$id . ';';

        Connection::queryMulti($query);

        header('location: /');
    }

    public static function deleteFather($id = 0, $catId = 0) {
        $query = '
            delete from cats_fathers 
            where
                cat_id = ' . (int)$catId . ' and
                id = ' . (int)$id
        ;

        Connection::queryMulti($query);

        header('location: /' . (int)$catId);
    }
}
