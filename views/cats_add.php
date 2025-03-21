<?php use lib\Html; ?>

<form style="width: 200px;" method="POST">
    <?php if ($id) { ?>
        <input type="hidden" name="row[id]" value="<?= $id ?>">
    <?php } ?>
    
    name<br>
    <input name="row[name]" value="<?= Html::value('name', $row) ?>" style="width: 100%;"><br>

    mother<br>
    <select name="row[mother_id]">
        <option></option>
        <?php foreach($list as $option) { ?>
            <?php if ($option['id'] == Html::value('mother_id', $row)) { ?>
                <option value="<?= $option['id'] ?>" selected><?= $option['name'] ?></option>
            <?php } else { ?>
                <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
            <?php } ?>
        <?php } ?>
    </select><br>

    age<br>
    <input name="row[age]" value="<?= Html::value('age', $row, 1) ?>" style="width: 100%;"><br>

    female(кошка) 
    <input type="hidden" name="row[female]" value="">
    <input type="checkbox" name="row[female]" value="1" <?= Html::checked('female', $row) ?>><br><br>
    
    <?php if (!$id) { ?>
        father<br>
        <select name="father[id]">
            <option></option>
            <?php foreach($fathersList as $option) { ?>
                <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
            <?php } ?>
        </select><br>
    <?php } ?>
    
    <div style="text-align: right;">
        <input type="submit">
    </div>
</form>