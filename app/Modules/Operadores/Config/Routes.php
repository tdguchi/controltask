<?php

$routes->group("operadores", ["namespace" => "App\Modules\Operadores\Controllers"], function ($routes) {

	$routes->get("/", "Operadores::index");
	$routes->get("(:any)", "Operadores::$1");
	$routes->post("(:any)", "Operadores::$1");
});
