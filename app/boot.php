<?php

# Composer autoloader
require __DIR__.'/vendor/autoload.php';

# Create app with default environment ('development')
$app = new Framework\Application('usedb');

# Configurations
$app->registerPaths(include __DIR__.'/paths.php');
Framework\Database::configure($app->getConfig('database'));
Framework\View::configure($app->getConfig('view'));

# Include controllers
require 'routes.php';

return $app;