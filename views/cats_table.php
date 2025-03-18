
<form style="display: inline-block;">
    age: <input name="age" value="<?= $_GET['age'] ?>">
    female:
        <select name="female">
            <option></option>
            <option value="0" <?= $femaleSelect[0] ?>>no</option>
            <option value="1" <?= $femaleSelect[1] ?>>yes</option>
        </select>
    <input type="submit">
</form>

<a href="/"><button>Сбросить</button></a>

<table>
    <tr>
        <td>name</td>
        <td>mother</td>
        <td>age</td>
        <td>female</td>
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
        </tr>
    <?php } ?>
</table>
