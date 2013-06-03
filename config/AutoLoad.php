<?php
function loadControl($className) {
	$path = 'controllers/'.$className.'.php';
	if (file_exists($path)) {
		require_once $path;
	}
}

function loadModel($className) {
	$path = 'models/'.$className.'.php';
	if (file_exists($path)) {
		require_once $path;
	}
}

function loadSystem($className) {
	$path = 'systems/core/'.$className.'.php';
	if (file_exists($path)) {
		require_once $path;
	}
}

spl_autoload_register('loadControl');
spl_autoload_register('loadModel');
spl_autoload_register('loadSystem');