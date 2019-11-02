<?php

require_once('../d-core/load.php');
loadCore('cycle.php');
loadCore('flash.php');
loadCore('general.php');
loadCore('db.php');
loadCustom('extra.php');

cycleStart();

$back = 'index.php';

$fillables = ['id', 'note'];

//check if the full form has been submitted & set variables
foreach ($fillables as $fillable) {
    if (!isset($_POST[$fillable])) {
        setAlert('Something went wrong.', 'danger');
        redirect($back);
    } else {
        //set flashes
        //this can also be split to it's own loop for when you need non-bail behaviour
        $$fillable = $_POST[$fillable];
        setFlash($fillable, $$fillable);
    }
}

//validate id
if (!noteExists($id)) {
    setAlert('Something went wrong.', 'danger');
    redirect();
}

if (empty($note)) {
    setAlert('Please enter a note.', 'danger');
    redirect($back);
}

if (query('update `notes` set content = ? where id = ?', [$note, $id])) {
    setAlert('Note updated successfully.', 'success');
    $note = fetchNote($id);
    $back = 'person.php?id=' . $note['person_id'];
    redirect($back);
} else {
    setAlert('Unable to delete.', 'danger');
    redirect($back);
}

cycleEnd();
