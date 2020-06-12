<?php

function processInput()
{
	return implode('/', array_slice(explode('/', $_SERVER['REQUEST_URI']), 2));
}

function processParams($params_str)
{
	$params = array();
	for ($i = 0, $n = count($params_str); $i < $n; $i++) {
		$params[$params_str[$i++]] = $params_str[$i];
  }

	return $params;
}

$uri = explode('/', processInput());

if (empty($uri) || $uri[0] === '') {
	die('Invalid request');
}

$controller = null;
$action = ucwords('index');
$params = array();

switch (count($uri)) {
	case 1:
		$controller = ucwords($uri[0]);
		break;
	case 2:
		$controller = ucwords($uri[0]);
		$action = ucwords($uri[1]);
		break;
	default:
		$controller = ucwords($uri[0]);
		$action = ucwords($uri[1]);
		$params = processParams(array_slice($uri, 2));
		break;
}

if ($controller !== null) {
	if (!is_file('controllers/' . $controller . '.php')) {
		die('Invalid controller');
	}

	require_once 'controllers/' . $controller . '.php';
  $class = $controller . 'Controller';
	$c = new $class();

	if (method_exists($c, 'action' . $action)) {
		echo !empty($params) ? json_encode($c->{'action' . $action}($params)) : json_encode($c->{'action' . $action}());
	} else {
		die('Invalid action');
	}
}
