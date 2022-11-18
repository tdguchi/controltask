<?php

$routes->group("menuconfiguration", ["namespace" => "App\Modules\MenuConfiguration\Controllers"], function ($routes) {

	$routes->get("/", "MenuConfiguration::index");
	$routes->get("(:any)", "MenuConfiguration::$1");
	$routes->post("(:any)", "MenuConfiguration::$1");
});
