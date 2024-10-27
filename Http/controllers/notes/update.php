<?php


use core\Validator;

$db = \core\App::resolve('core\Database');

$currentUserid = 1;

// find the corresponding note
$note = $db->query("select * from notes where id = :id", ['id' => $_POST['id']])->findOrFail();

// authorize the current user to edit the note
authorize($note['user_id'] === $currentUserid);

// validate the form
$errors = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A Body of no more than 1000 characters is required';

}

// if no validation errors are encountered, the update the notes database table
if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);

}

$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

// redirect the user back to the notes page
header('Location: /notes');
exit();

