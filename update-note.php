<?php

require_once('d-core/load.php');
loadCore('cycle.php');
cycleStart();
loadCore('general.php');
loadCore('page.php');
loadCore('db.php');
loadCustom('extra.php');

$id = _get('id');

//validate id
if (!noteExists($id)) {
    setAlert('Something went wrong.', 'danger');
    redirect();
}

$note = fetchNote($id);

putHeader();
?>
<section>
    <div class="container">
        <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" class="row">
            <div data-aos="fade-right" data-aos-anchor-placement="center-bottom" class="col-md-6 d-flex align-items-center mb-3">
                <img class="img-fluid" src="assets/images/2.svg">
            </div>
            <div class="col-md-6 d-flex align-items-center mb-3">
                <div class="w-100">
                    <h2>Update Note</h2>
                    <?= putNote($note) ?>
                    <form method="post" action="d-processors/update-note.php">
                        <input type="hidden" name="id" value="<?= $note['id'] ?>">
                        <div class="form-group">
                            <textarea class="form-control" name="note" rows="4"><?= $note['content'] ?></textarea>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Update Note</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
putFooter();
cycleEnd();
