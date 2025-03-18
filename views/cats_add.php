<form style="width: 200px;" method="POST">
    <?php if ($id) { ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php } ?>
    
    name<br>
    <input name="name" value="<?= $row['name'] ?>" style="width: 100%;"><br>

    mother<br>
    <select name="mother_id">
        <option></option>
        <?php foreach($list as $optionRow) { ?>
            <?php if ($optionRow['id'] == $row['mother_id']) { ?>
                <option value="<?= $optionRow['id'] ?>" selected><?= $optionRow['name'] ?></option>
            <?php } else { ?>
                <option value="<?= $optionRow['id'] ?>"><?= $optionRow['name'] ?></option>
            <?php } ?>
        <?php } ?>
    </select><br>

    age<br>
    <input name="age" value="<?= $row['age'] ?>" style="width: 100%;"><br>

    female(кошка) 
    <input type="hidden" name="female" value="">
    <input type="checkbox" name="female" value="1" <?= $femaleChecked ?>><br><br>
    
    <div style="text-align: right;">
        <input type="submit">
    </div>
</form>