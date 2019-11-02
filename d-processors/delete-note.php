<?php

require_once('../d-core/load.php');
loadCore('cycle.php');
loadCore('flash.php');
loadCore('general.php');
loadCore('db.php');
loadCustom('extra.php');

cycleStart();

$back = 'index.php';

$id = _post('id');

//validate id
if (!noteExists($id)) {
    setAlert('Something went wrong.', 'danger');
    redirect();
}

$note = fetchNote($id);

$back = 'person.php?id=' . $note['person_id'];

if (query('delete from `notes` where id = ?', [$id])) {
    setAlert('Note deleted successfully.', 'success');
    redirect($back);
} else {
    setAlert('Unable to delete.', 'danger');
    redirect($back);
}

cycleEnd();
