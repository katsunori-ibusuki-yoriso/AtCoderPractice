<?php

use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{
    /**
     * @test
     * @dataProvider inputOutputProvider
     */
    public function testProcessInput($inputFile, $outputFile)
    {
        $inputData = file_get_contents($inputFile);
        $expectedOutput = file_get_contents($outputFile);

        // PHPの内部で標準入力をファイルから読み込むストリームを作成
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, $inputData);
        rewind($stream);

        // 標準入力を一時的に置き換える
        $originalStdin = fopen('php://stdin', 'r');
        $GLOBALS['STDIN'] = $stream;

        // 出力をキャプチャする
        ob_start();
        processInput();
        $actualOutput = ob_get_clean();

        // 標準入力を元に戻す
        fclose($GLOBALS['STDIN']);
        $GLOBALS['STDIN'] = $originalStdin;
        // アサーションの実行
        $this->assertSame($expectedOutput, $actualOutput);
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
