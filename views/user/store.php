<?php

declare(strict_types=1);

use App\Controllers\UserController;

require_once $_SERVER['DOCUMENT_ROOT'] . '/database/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Controllers/UserController.php';

$newUser = new UserController();
$newUser->store($_POST["first_name"], $_POST["last_name"], $_POST["password"], $_POST["date_of_birth"], $_POST["group"]);


