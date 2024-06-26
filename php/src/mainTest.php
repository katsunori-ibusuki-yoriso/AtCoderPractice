<?php

use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{
    public function testProcessInput()
    {
        $inputFile = '/usr/src/app/common/input/test1.in';
        $outputFile = '/usr/src/app/common/output/test1.out';

        $inputData = file_get_contents($inputFile);
        $expectedOutput = file_get_contents($outputFile);

        $actualOutput = processInput($inputData);

        $this->assertEquals($expectedOutput, $actualOutput);
    }
}
