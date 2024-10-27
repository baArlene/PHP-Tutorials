<?php



$email = $_POST['email'];
$password = $_POST['password'];

//validate email and password (form inputs)
$errors = [];
if (! \core\Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email';
}

if (! \core\Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least 7 characters';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
     'errors' => $errors
    ]);
}

$db = \core\App::resolve(\core\Database::class);
// check email and password already exists
$result = $db->query('select * from users where email = :email', [
    ':email' => $email
])->find();


if ($user) {
    // then someone with that email already exists
    // if yes then redirect to sig in page
    header('Location: /');
    exit();
} else {
    // if no, save one to the database, and then log the user in, and redirect
    $db->query('insert into users (email, password) values (:email, :password)', [
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // log the user in
    login($user);

    // redirect to the home page
    header('Location: /');
    exit();
}

