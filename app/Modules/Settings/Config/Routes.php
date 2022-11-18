<?php

$routes->group("settings", ["namespace" => "App\Modules\Settings\Controllers"], function ($routes) {

	$routes->get("/", "Settings::index");
	$routes->get("(:any)", "Settings::$1");
	$routes->post("(:any)", "Settings::$1");
});
