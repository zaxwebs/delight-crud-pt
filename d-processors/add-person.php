<?php

require_once('../d-core/load.php');
loadCore('cycle.php');
loadCore('flash.php');
loadCore('general.php');
loadCore('db.php');
cycleStart();

$back = 'add-person.php';

$fillables = ['name', 'intro', 'submit'];

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

if (empty($name)) {
    setAlert('Please enter a name.', 'danger');
    redirect($back);
}

if (query('insert into `people` (name, intro) values (?, ?)', [$name, $intro])) {
    foreach ($fillables as $fillable) {
        unsetFlash($fillable);
    }
    setAlert($name . ' was added successfully.', 'success');
    redirect();
} else {
    setAlert('Unable to save.', 'danger');
    redirect($back);
}

cycleEnd();
