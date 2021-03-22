<?php

include_once __DIR__ ."/../vendor/autoload.php";
use controllers\MemoriesController;
use app\Router;

$router = new Router();

$router->get("/", [MemoriesController::class, 'index']);
$router->get("/memories", [MemoriesController::class, 'index']);
$router->get("/memories/details", [MemoriesController::class, 'details']);
$router->get("/memories/create", [MemoriesController::class, 'create']);
$router->post("/memories/create", [MemoriesController::class, 'create']);
$router->get("/memories/update", [MemoriesController::class, 'update']);
$router->post("/memories/update", [MemoriesController::class, 'update']);
$router->get("/memories/delete", [MemoriesController::class, 'delete']);

$router->resolve();
