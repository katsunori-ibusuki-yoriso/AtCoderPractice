<?php

function processInput($input): string
{
    return strtoupper($input);
}

if (php_sapi_name() === 'cli' && !empty($argv)) {
    $input = file_get_contents('php://stdin');
    $output = processInput($input);
    echo $output;
}
