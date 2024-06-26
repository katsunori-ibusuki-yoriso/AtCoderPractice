#include <cassert>
#include <fstream>
#include <iostream>
#include <sstream>
#include <string>

// グローバル変数
std::streambuf *oldCin;
std::streambuf *oldCout;
std::stringstream inputBuffer;
std::stringstream outputBuffer;

void processInput();

// initIO関数
void initIO(const std::string &inputFile, const std::string &outputFile,
            std::string &expectedOutput) {
  // 入力データを読み込む
  std::ifstream input(inputFile);
  if (!input) {
    throw std::runtime_error("Failed to open input file");
  }
  inputBuffer << input.rdbuf();
  input.close();

  // 期待される出力データを読み込む
  std::ifstream expectedOutputFile(outputFile);
  if (!expectedOutputFile) {
    throw std::runtime_error("Failed to open output file");
  }
  std::stringstream expectedOutputBuffer;
  expectedOutputBuffer << expectedOutputFile.rdbuf();
  expectedOutput = expectedOutputBuffer.str();
  expectedOutputFile.close();

  // 標準入力をリダイレクトする
  oldCin = std::cin.rdbuf(inputBuffer.rdbuf());

  // 標準出力をキャプチャする
  oldCout = std::cout.rdbuf(outputBuffer.rdbuf());
}

// closeIO関数
std::string closeIO() {
  // 標準出力のキャプチャを終了する
  std::cout.rdbuf(oldCout);

  // 標準入力を元に戻す
  std::cin.rdbuf(oldCin);

  // キャプチャした標準出力を取得する
  return outputBuffer.str();
}

// テスト関数
void runTest(const std::string &inputFile, const std::string &outputFile) {
  std::string expectedOutput;

  // 入出力を初期化する
  try {
    initIO(inputFile, outputFile, expectedOutput);
  } catch (const std::exception &e) {
    std::cerr << e.what() << std::endl;
    assert(false && "Initialization failed");
  }

  // テスト対象の関数を実行する
  processInput();

  // 入出力をクローズする
  std::string actualOutput = closeIO();

  // 出力が期待されるものと一致するか確認する
  assert(actualOutput == expectedOutput &&
         "Output does not match expected output");
}

int main() {
  runTest("../common/input/test1.in", "../common/output/test1.out");
  std::cout << "All tests passed!" << std::endl;
  return 0;
}
