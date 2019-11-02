<?php

require_once('../d-core/load.php');
loadCore('cycle.php');
loadCore('flash.php');
loadCore('general.php');
loadCore('db.php');
loadCustom('extra.php');

cycleStart();

$back = 'person.php?id=' . _post('id');

$fillables = ['note', 'id', 'submit'];

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
if (!personExists($id)) {
    setAlert('Something went wrong.', 'danger');
    //if person doesn't exist unset flashes and redirect to home
    unsetFlash('id');
    unsetFlash('note');
    redirect();
}

if (empty($note)) {
    setAlert('Please enter a note.', 'danger');
    redirect($back);
}

if (query('insert into `notes` (content, person_id) values (?, ?)', [$note, $id])) {
    foreach ($fillables as $fillable) {
        unsetFlash($fillable);
    }
    setAlert('Note added successfully.', 'success');
    redirect($back);
} else {
    setAlert('Unable to save.', 'danger');
    redirect($back);
}

cycleEnd();
