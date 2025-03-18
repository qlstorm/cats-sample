<form method="POST">
    <select name="id">
        <?php foreach($list as $row) { ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
        <?php } ?>
    </select><br><br>
    <div>
        <input type="submit">
    </div>
</form>