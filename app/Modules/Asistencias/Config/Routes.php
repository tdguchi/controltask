<?php

$routes->group("asistencias", ["namespace" => "App\Modules\Asistencias\Controllers"], function ($routes) {

	$routes->get("/", "Asistencias::index");
	$routes->get("(:any)", "Asistencias::$1");
	$routes->post("(:any)", "Asistencias::$1");
});
