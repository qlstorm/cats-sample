<table>
    <tr>
        <td>name</td>
        <td>mother</td>
        <td>age</td>
        <td>female</td>
        <td></td>
    </tr>

    <?php foreach ($list as $row) { ?>
        <tr>
            <td><a href="/<?= $row['id'] ?>"><?= $row['name'] ?></a></td>
            <?php if ($row['mother_name']) { ?>
                <td><a href="/<?= $row['mother_id'] ?>"><?= $row['mother_name'] ?></a></td>
            <?php } else { ?>
                <td>no</td>
            <?php } ?>
            <td><?= $row['age'] ?></td>
            <td><?= $row['female_title'] ?></td>
            <td><a href="/index/deleteFather/<?= $row['id'] ?>/<?= $parentId ?>"><button>delete</button></a></td>
        </tr>
    <?php } ?>
</table>
