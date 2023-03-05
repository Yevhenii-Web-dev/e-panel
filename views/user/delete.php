<?php

declare(strict_types=1);

use App\Controllers\UserController;

require_once $_SERVER['DOCUMENT_ROOT'] . '/database/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Controllers/UserController.php';

$newUser = new UserController();
$newUser->destroy((int) $_GET['id']);


