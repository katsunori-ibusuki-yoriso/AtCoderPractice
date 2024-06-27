<?php

function processInput()
{
    fscanf(STDIN, "%d %d %d\n", $a, $b, $c);
    $s = trim(fgets(STDIN));
    $sum = $a + $b + $c;
    return $sum . ' ' . $s . "\n";
}

// 標準入力を処理
if (getenv('UNIT_TEST') !== '1') {
    echo processInput();
}
