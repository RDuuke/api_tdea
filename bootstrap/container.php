<?php
$container = $app->getContainer();
$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container["settings"]["db"]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container["db"] = function () use ($capsule) {
    return $capsule;
};

$container["UserController"] = function ($container)  {
  return new \Api\Controllers\UserController($container);
};

$container["ProductController"] = function ($container)  {
    return new \Api\Controllers\ProductController($container);
};

$container["ClientController"] = function ($container)  {
    return new \Api\Controllers\ClientController($container);
};

$container["OrderController"] = function ($container) {
  return new \Api\Controllers\OrderController($container);
};

$container["auth"] = function () {
    return new Api\Auth\Auth();
};