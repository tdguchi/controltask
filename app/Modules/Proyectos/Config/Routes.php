<?php

$routes->group("proyectos", ["namespace" => "App\Modules\Proyectos\Controllers"], function ($routes) {

	$routes->get("/", "Proyectos::index");
	$routes->get("(:any)", "Proyectos::$1");
	$routes->post("(:any)", "Proyectos::$1");
});
