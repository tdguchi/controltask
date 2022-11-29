<?php

$routes->group("horarios", ["namespace" => "App\Modules\Horarios\Controllers"], function ($routes) {

	$routes->get("/", "Horarios::index");
	$routes->get("(:any)", "Horarios::$1");
	$routes->post("(:any)", "Horarios::$1");
});
