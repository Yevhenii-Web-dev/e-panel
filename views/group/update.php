<?php

declare(strict_types=1);

use App\Controllers\GroupController;

require_once $_SERVER['DOCUMENT_ROOT'] . '/database/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Controllers/GroupController.php';

$obj = new GroupController();
$obj->update((int) $_GET["id"] ,$_POST["name"]);


