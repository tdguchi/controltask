<?php

$routes->group("users", ["namespace" => "App\Modules\Users\Controllers"], function ($routes) {

	$routes->get("/", "Users::index");
	$routes->get("(:any)", "Users::$1");
	$routes->post("(:any)", "Users::$1");
});
