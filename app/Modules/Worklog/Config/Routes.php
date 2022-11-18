<?php

$routes->group("worklog", ["namespace" => "App\Modules\Worklog\Controllers"], function ($routes) {

	$routes->get("/", "Worklog::index");
	$routes->get("(:any)", "Worklog::$1");
	$routes->post("(:any)", "Worklog::$1");
});
