<?php

namespace lib;

class Cats {

    public static function getList() {
        $filter = [];

        if (isset($_GET['id']) && $_GET['id']) {
            $filter[] = 'cats.id = ' . (int)$_GET['id'];
        }

        if (isset($_GET['age']) && $_GET['age']) {
            $filter[] = 'cats.age = ' . (int)$_GET['age'];
        }

        if (isset($_GET['female']) && $_GET['female'] == 0) {
            $filter[] = 'cats.female is null';
        }

        if (isset($_GET['female']) && $_GET['female']) {
            $filter[] = 'cats.female = ' . (int)$_GET['female'];
        }

        if (isset($_GET['child']) && $_GET['child']) {
            $filter[] = '
                cats.id in (
                    select id from cats_fathers
                    where
                        cat_id = ' . (int)$_GET['child'] . '
                )
            ';
        }

        $query = '
            select
                cats.*,
                mother.name mother_name
            from cats
            left join cats mother on mother.id = cats.mother_id
        ';

        if ($filter) {
            $query .= ' where ' . implode(' and ', $filter);
        }

        $res = Connection::query($query);

        $list = [];

        while ($row = $res->fetch_assoc()) {
            if ($row['female']) {
                $row['female_title'] = 'yes';
            } else {
                $row['female_title'] = 'no';
            }

            $list[] = $row;
        }

        return $list;
    }

    private static function getOptions($noIdList) {
        $query = 'select id, name from cats';

        if ($noIdList) {
            $query .= ' where id not in ('. implode(', ', $noIdList) . ')';
        }

        return Connection::query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public static function add($row, $id) {
        if ($row) { 
            Connection::insert('cats', $row);

            if (!$id) {
                $id = Connection::insertId();
            }

            header('location: /' . $id);

            exit;
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

        $list = self::getOptions([$id]);

        require 'views/cats_add.php';
    }

    public static function view($id) {
        $_GET['id'] = $id;

        $list = self::getList();

        $row = $list[0];

        $_GET = [
            'child' => $id
        ];

        $fathers = self::getList();

        require 'views/cats_view.php';
    }

    public static function addFather($row, $catId) {
        if ($row) {
            $row['cat_id'] = $catId;

            Connection::insert('cats_fathers', $row);

            header('location: /' . $catId);

            exit;
        }

        $res = Connection::query('select id from cats_fathers where cat_id = ' . (int)$catId)->fetch_all();

        $noIdList = array_column($res, 0);

        $noIdList[] = $catId;

        $list = self::getOptions($noIdList);

        require 'views/cats_add_father.php';
    }

    public static function delete($id) {
        $query = 'delete from cats where id = ' . (int)$id . ';';

        $query .= 'delete from cats_fathers where cat_id = ' . (int)$id . ';';

        Connection::queryMulti($query);

        header('location: /');
    }

    public static function deleteFather($id, $parentId = 0) {
        $query = '
            delete from cats_fathers 
            where
                cat_id = ' . (int)$parentId . ' and
                id = ' . (int)$id
        ;

        Connection::queryMulti($query);

        header('location: /' . (int)$parentId);
    }
}
