<?php


$email = $_POST['email'];
$password = $_POST['password'];

$form = new \Http\forms\LoginForm();

if ($form->validate($email, $password)) {

    if ((new \core\Authenticator)->attempt($email, $password)) {
        redirect('/');
    }

    $form->error('email', 'No matching account found for that email address and password.');
};

\core\Session::flash('errors', $form->errors());
\core\Session::flash('old', [
    'email' => $_POST['email'],
]);

return redirect('/login');





