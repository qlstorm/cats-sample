
<form style="display: inline-block;">
    age: <input name="age" value="<?= $_GET['age'] ?>">
    female:
        <select name="female">
            <option></option>

            <?php foreach ($femaleFilter as $femaleValue) { ?>
                <option value="<?= $femaleValue['value'] ?>" <?= $femaleValue['selected'] ?>><?= $femaleValue['name'] ?></option>
            <?php } ?>
        </select>
    order:
        <select name="order">
            <?php foreach ($orders as $order) { ?>
                <option value="<?= $order['value'] ?>" <?= $order['selected'] ?>><?= $order['name'] ?></option>
            <?php } ?>
        </select>
    <input type="submit">
</form>

<a href="/"><button>Сбросить</button></a>

<table>
    <tr>
        <td>id</td>
        <td>name</td>
        <td>mother</td>
        <td>age</td>
        <td>female</td>
    </tr>

    <?php foreach ($list as $row) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
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
