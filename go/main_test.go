package main

import (
	"io"
	"os"
	"path/filepath"
	"testing"
)

var (
	oldStdin    *os.File
	oldStdout   *os.File
	stdinReader *os.File
	stdinWriter *os.File
	r           *os.File
	w           *os.File
)

func initIO(inputFile, outputFile string) ([]byte, []byte, error) {
	// 入力データを読み込む
	inputData, err := os.ReadFile(inputFile)
	if err != nil {
		return nil, nil, err
	}

	// 期待される出力データを読み込む
	expectedOutput, err := os.ReadFile(outputFile)
	if err != nil {
		return nil, nil, err
	}

	// 標準入力をリダイレクトする
	stdinReader, stdinWriter, err = os.Pipe()
	if err != nil {
		return nil, nil, err
	}

	oldStdin = os.Stdin
	os.Stdin = stdinReader

	go func() {
		defer stdinWriter.Close()
		stdinWriter.Write(inputData)
	}()

	// 標準出力をキャプチャする
	r, w, _ = os.Pipe()
	oldStdout = os.Stdout
	os.Stdout = w

	return inputData, expectedOutput, nil
}

func closeIO() ([]byte, error) {
	// 標準出力のキャプチャを終了する
	w.Close()
	os.Stdout = oldStdout

	// キャプチャした標準出力を読み込む
	actualOutput, err := io.ReadAll(r)
	if err != nil {
		return nil, err
	}

	// 標準入力を元に戻す
	os.Stdin = oldStdin

	return actualOutput, nil
}

func Test_main(t *testing.T) {
	inputDir := "./common/input/A001"
	outputDir := "./common/output/A001"
	err := filepath.Walk(inputDir, func(path string, info os.FileInfo, err error) error {
		if err != nil {
			return err
		}

		if !info.IsDir() && filepath.Ext(path) == ".in" {
			inputFile := path
			outputFile := filepath.Join(outputDir, info.Name()[:len(info.Name())-len(filepath.Ext(info.Name()))]+".out")

			_, expectedOutput, err := initIO(inputFile, outputFile)
			if err != nil {
				t.Fatalf("Failed to initialize IO: %s", err)
			}

			// プログラムを実行する
			main()

			actualOutput, err := closeIO()
			if err != nil {
				t.Fatalf("Failed to close IO: %s", err)
			}

			// 出力が期待されるものと一致するか確認する
			if string(actualOutput) != string(expectedOutput) {
				t.Errorf("Test failed for file: %s\nExpected output:\n%s\nBut got:\n%s", inputFile, expectedOutput, actualOutput)
			}
		}
		return nil
	})

	if err != nil {
		t.Fatalf("Error walking the path %q: %v\n", inputDir, err)
	}
}
