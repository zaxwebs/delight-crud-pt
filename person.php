<?php

require_once('d-core/load.php');
loadCore('cycle.php');
cycleStart();

loadCore('page.php');
loadCore('general.php');
loadCore('db.php');
loadCustom('extra.php');
putHeader();

$id = _get('id');

if (!personExists($id)) {
    setAlert('Person not found.', 'danger');
    redirect();
}

$person = fetchPerson($id);
?>
<section>
    <div class="container">
        <div data-aos="fade-up" class="row flex-column-reverse flex-md-row">
            <div class="col-md-6 d-flex align-items-center mb-3">
                <div class="w-100">
                    <h3 class="text-primary">All About</h3>
                    <h2><?= $person['name'] ?></h2>
                    <p class="grey mb-5">
                        <?= $person['intro'] ?>
                    </p>
                    <form method="post" action="d-processors/add-note.php">
                        <input type="hidden" name="id" value="<?= htmlentities($person['id']) ?>">
                        <div class="form-group">
                            <textarea class="form-control" name="note" rows="4" placeholder="Write something you'd like to remember about <?= $person['name'] ?>."></textarea>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Add Note</button>
                    </form>
                </div>
            </div>
            <div data-aos="fade-left" class="col-md-6 d-flex align-items-center mb-3">
                <img class="img-fluid" src="assets/images/4.svg">
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <?php

        $notes_count = fetchColumn('select count(*) from notes where person_id = ?', [$person['id']]);

        if ($notes_count === 0) {
            echo '<h3 class="text-center text-black-50">There are no notes yet about ' . htmlentities($person['name']) . '</h3>';
        } else {
            $notes = fetchAll('select * from notes where person_id = ? order by id DESC', [$person['id']]);
            ?>
            <h2>Notes About <?= htmlentities($person['name']) ?></h2>
            <?php
                foreach ($notes as $note) {
                    putNote($note, true);
                }
                ?>
        <?php
        }

        ?>

    </div>
</section>
<?php
putFooter();
cycleEnd();
