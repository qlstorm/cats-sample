
<form style="display: inline-block;">
    age: <input name="age" value="<?= lib\Html::value('age') ?>">
    female:
        <select name="female">
            <option></option>

            <?php lib\Html::options([
                '1' => 'yes',
                '0' => 'no'
            ], 'female') ?>
        </select>
    order:
        <select name="order">
            <?php lib\Html::options([
                'id desc' => 'id desc',
                'id' => 'id',
                'name desc' => 'name desc',
                'name' => 'name',
                'female desc' => 'female desc',
                'female' => 'female',
                'age desc' => 'age desc',
                'age' => 'age',
                'fathers desc' => 'fathers desc',
                'fathers' => 'fathers'
            ], 'order') ?>
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
            <td><?= $row['female_name'] ?></td>
        </tr>
    <?php } ?>
</table>
