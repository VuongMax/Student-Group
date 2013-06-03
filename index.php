<?php
require_once 'Router.php';

session_name('__cmt');
session_start();

$router = NULL;
if (isset($_SERVER['PATH_INFO'])) {
	$router = new Router($_SERVER['PATH_INFO']);

} else {
	$router = new Router();
}

$router->dispatch();