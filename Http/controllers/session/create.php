<?php

view('session/create.view.php', [
    'errors' => \core\Session::get('errors'),
]);