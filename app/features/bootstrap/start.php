<?php
// Command that starts the built-in web server
$command = 'php -S localhost:4567 -t server.php >/dev/null 2>&1 & echo $!';
 
// Execute the command and store the process ID
$output = array(); 
exec($command, $output);
$pid = (int) $output[0];
 
// Kill the web server when the process ends
register_shutdown_function(function() use ($pid) {
    echo sprintf('%s - Killing process with ID %d', date('r'), $pid) . PHP_EOL;
    exec('kill ' . $pid);
});

