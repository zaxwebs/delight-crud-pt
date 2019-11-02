<?php

function excerptify($string, $length)
{
    if (strlen($string) > $length) {
        return substr($string, 0, $length) . '...';
    }
    return $string;
}

function personExists($id)
{
    $count = fetchColumn('select count(*) from people where id=?', [$id]);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function noteExists($id)
{
    $count = fetchColumn('select count(*) from notes where id=?', [$id]);
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function fetchNote($id)
{
    return fetch('select notes.id, notes.content, notes.time, notes.person_id, people.name from `notes` inner join `people` on notes.person_id = people.id where notes.id = ?', [$id]);
}

function fetchPerson($id)
{
    return fetch('select * from people where id=?', [$id]);
}

function formatTime($timeString)
{
    return date('j M y, g:i a', strtotime($timeString));
}

function putNote($note, $buttons = false)
{
    ?>
    <div class="note">
        <?php
            if (isset($note['name'])) {
                echo '<a href="person.php?id=' . $note['person_id'] . '">' . $note['name'] . '</a>';
            }
            ?>
        <p><?= $note['content'] ?></p>
        <span class="text-black-50"><?= formatTime($note['time']) ?></span>
        <?php
            if ($buttons) {
                ?>
            <hr />

            <form method="post" class="form-inline" action="d-processors/delete-note.php">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <button type="submit" class="btn btn-outline-primary btn-sm mr-4">Delete</button>
                <a class="btn btn-outline-primary btn-sm" href="update-note.php?id=<?= $note['id'] ?>">Update</a>
            </form>
        <?php
            }
            ?>
    </div>
<?php
}
