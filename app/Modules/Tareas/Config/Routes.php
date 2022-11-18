<?php

$routes->group("tareas", ["namespace" => "App\Modules\Tareas\Controllers"], function ($routes) {

	$routes->get("/", "Tareas::index");
	$routes->get("(:any)", "Tareas::$1");
	$routes->post("(:any)", "Tareas::$1");
});
