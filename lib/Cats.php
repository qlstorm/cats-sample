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

        if (isset($_GET['female']) && $_GET['female'] == '0') {
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

        $order = 'cats.id';
        $direction = 'desc';

        if (isset($_GET['order']) && $_GET['order']) {
            $orderData = explode(' ', $_GET['order']);

            $order = Connection::escape($orderData[0]);

            $direction = '';

            if (isset($orderData[1])) {
                $direction = Connection::escape($orderData[1]);
            }
        }

        if ($order == 'fathers') {
            $order = '
                (
                    select count(*) from cats_fathers where cat_id = cats.id
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

        $query .= ' order by ' . $order . ' ' . $direction;

        $res = Connection::query($query);

        $list = [];

        while ($row = $res->fetch_assoc()) {
            if ($row['female']) {
                $row['female_name'] = 'yes';
            } else {
                $row['female_name'] = 'no';
            }

            $list[] = $row;
        }

        return $list;
    }

    public static function getMotherOptions($id) {
        $filter = [
            'female = 1'
        ];

        if ($id) {
            $filter[] = 'cats.id <> ' . (int)$id;

            $filter[] = 'age > (
                select age from cats where id = ' . (int)$id . '
            )';
        }

        $query = '
            select
                cats.id,
                cats.name
            from cats
        ';

        $query .= ' where ' . implode(' and ', $filter);

        return Connection::query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public static function getFatherOptions($catId = 0) {
        $filter = [
            'female is null'
        ];

        if ($catId) {
            $filter[] = 'cats.id <> ' . (int)$catId;

            $filter[] = 'age > (
                select age from cats where id = ' . (int)$catId . '
            )';

            $filter[] = 'cats.id not in (
                select id from cats_fathers where cat_id = ' . (int)$catId . '
            )';
        }

        $query = '
            select
                cats.id,
                cats.name
            from cats
        ';

        $query .= ' where ' . implode(' and ', $filter);

        return Connection::query($query)->fetch_all(MYSQLI_ASSOC);
    }
}
