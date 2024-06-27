<?php

use PHPUnit\Framework\TestCase;

require_once 'main.php';

class MainTest extends TestCase
{
    /**
     * @dataProvider inputOutputProvider
     */
    public function testProcessInput($inputFile, $outputFile)
    {
        $inputData = file_get_contents($inputFile);
        $expectedOutput = file_get_contents($outputFile);

        // PHPの内部で標準入力をファイルから読み込むストリームを作成
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $inputData);
        rewind($stream);

        // 標準入力を差し替える
        global $stdin;
        $stdin = $stream;

        // 関数を実行して出力をキャプチャ
        ob_start();
        $actualOutput = processInput();
        $actualOutput = ob_get_clean();

        // アサーションの実行
        $this->assertSame(trim($expectedOutput), trim($actualOutput));
    }

    public function inputOutputProvider()
    {
        $inputDir = '/usr/src/app/common/input/A001/';
        $outputDir = '/usr/src/app/common/output/A001/';

        $testCases = [];
        $inputFiles = glob($inputDir . '*.in');

        foreach ($inputFiles as $inputFile) {
            $baseName = basename($inputFile, '.in');
            $outputFile = $outputDir . $baseName . '.out';
            if (file_exists($outputFile)) {
                $testCases[] = [$inputFile, $outputFile];
            }
        }

        return $testCases;
    }
}
