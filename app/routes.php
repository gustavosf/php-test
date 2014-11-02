<?php

use Framework\View;

$app->get('/', function() { 
	return View::forge('hello');
});