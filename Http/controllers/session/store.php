<?php


$form = \Http\forms\LoginForm::validate([
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new \core\Authenticator)->attempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) {
    $form->error(
        'email', 'No matching account found for that email address and password.'
    )->throw();
}
redirect('/');







