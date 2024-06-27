<?php

function processInput()
{
    $contents = \file_get_contents('php://stdin');
    $lines = explode("\n", $contents);
    $a = (int)$lines[0];
    $b = (int)$lines[1];
    $c = (int)$lines[2];
    $s = $lines[3];
    $sum = $a + $b + $c;
    var_dump($sum);
    return $sum . ' ' . $s . "\n";
}

// 標準入力を処理
if (getenv('UNIT_TEST') !== '1') {
    echo processInput();
}
