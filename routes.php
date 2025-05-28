<?php

use app\controlles\HomeController;
use app\controlles\UserController;
use app\controlles\ContactController;
use core\classes\Server;


$server = new Server();

$server->route("GET", "/", [UserController::class, 'index']);

$server->route("GET", "/users", [UserController::class, 'index']);
$server->route("GET", "/users/create", [UserController::class, 'create']);
$server->route("POST", "/users", [UserController::class, 'store']);
$server->route("GET", "/users/{id}/edit", [UserController::class, 'edit']);
$server->route("PUT", "/users/{id}", [UserController::class, 'update']);
$server->route("DELETE", "/users/{id}", [UserController::class, 'destroy']);

$server->route("GET", "/contacts", [ContactController::class, 'index']);
$server->route("POST", "/contacts", [ContactController::class, 'store']);
$server->route("GET", "/contacts/{id}", [ContactController::class, 'show']);
$server->route("PUT", "/contacts/{id}", [ContactController::class, 'update']);
$server->route("DELETE", "/contacts/{id}", [ContactController::class, 'destroy']);

$server->dispatch();