<?php

$db = \core\App::resolve('core\Database');

$currentUserid = 1;


$note = $db->query("select * from notes where id = :id", ['id' => $_GET['id']])->findOrFail();

authorize($note['user_id'] === $currentUserid);


view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note,
]);



