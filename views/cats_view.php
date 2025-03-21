<div>
    <a href="/">cats</a><br><br>
</div>

<a href="/father/add/<?= $row['id'] ?>"><button>add father</button></a>
<a href="/add/<?= $row['id'] ?>"><button>edit</button></a>
<a href="/index/delete/<?= $row['id'] ?>"><button>delete</button></a>

<p>
    name<br>
    <?= $row['name'] ?>
</p>
<p>
    mother<br>
    <?php if ($row['mother_id']) { ?>
        <a href="/<?= $row['mother_id'] ?>"><?= $row['mother_name'] ?></a>
    <?php } else { ?>
        no
    <?php } ?>
</p>
<p>
    age<br>
    <?= $row['age'] ?>
</p>
<p>
    female<br>
    <?= $row['female_name'] ?>
</p>
<p>
    fathers:

    <?php if ($fathers) { ?>
        <?php
            $parentId = $row['id'];

            $list = $fathers;

            require 'cats_table_father.php';
        ?>
    <?php } ?>

    <?php if (!$fathers) { ?>
        <br>none
    <?php } ?>
</p>