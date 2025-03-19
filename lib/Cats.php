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

    public static function getFatherOptions($catId) {
        $query = '
            select
                cats.id,
                cats.name
            from cats
            where
                cats.id <> ' . (int)$catId . ' and
                female is null and
                age > (
                    select age from cats where id = ' . (int)$catId . '
                ) and
                cats.id not in (
                    select id from cats_fathers where cat_id = ' . (int)$catId . '
                )
        ';

        return Connection::query($query)->fetch_all(MYSQLI_ASSOC);
    }
}
