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

        if (!isset($_GET['age'])) {
            $_GET['age'] = '';
        }

        $femaleFilter = [
            '1' => [
                'name' => 'yes',
                'value' => '1',
                'selected' => ''
            ],
            '0' => [
                'name' => 'no',
                'value' => '0',
                'selected' => ''
            ]
        ];

        if (isset($_GET['female']) && strlen($_GET['female'])) {
            $femaleFilter[$_GET['female']]['selected'] = 'selected';
        }

        $orders = [
            'id desc' => [
                'name' => 'id desc',
                'value' => 'id desc',
                'selected' => ''
            ],
            'id' => [
                'name' => 'id',
                'value' => 'id',
                'selected' => ''
            ],
            'name desc' => [
                'name' => 'name desc',
                'value' => 'name desc',
                'selected' => ''
            ],
            'name' => [
                'name' => 'name',
                'value' => 'name',
                'selected' => ''
            ],
            'frmale desc' => [
                'name' => 'frmale desc',
                'value' => 'frmale desc',
                'selected' => ''
            ],
            'frmale' => [
                'name' => 'frmale',
                'value' => 'frmale',
                'selected' => ''
            ],
            'age desc' => [
                'name' => 'age desc',
                'value' => 'age desc',
                'selected' => ''
            ],
            'age' => [
                'name' => 'age',
                'value' => 'age',
                'selected' => ''
            ],
            'fathers desc' => [
                'name' => 'fathers desc',
                'value' => 'fathers desc',
                'selected' => ''
            ],
            'fathers' => [
                'name' => 'fathers',
                'value' => 'fathers',
                'selected' => ''
            ]
        ];

        if (isset($_GET['order']) && $_GET['order']) {
            $orders[$_GET['order']]['selected'] = 'selected';
        }

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
