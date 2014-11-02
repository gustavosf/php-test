<?php

use Framework\View;

$app->get('/', function() { 
	$users = Model\User::all();
	return View::forge('users', ['users' => $users]);
});