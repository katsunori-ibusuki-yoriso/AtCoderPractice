
#include <gtest/gtest.h>
#include <sstream>
#include <string>

// プロトタイプ宣言
void processInput();

// 入力と出力をリダイレクトするヘルパー関数
void runWithInputOutput(const std::string &input, std::string &output) {
  std::istringstream inputBuffer(input);
  std::ostringstream outputBuffer;

  // 標準入力と出力をリダイレクト
  std::streambuf *oldCin = std::cin.rdbuf(inputBuffer.rdbuf());
  std::streambuf *oldCout = std::cout.rdbuf(outputBuffer.rdbuf());

  // テスト対象の関数を実行
  processInput();

  // リダイレクトを元に戻す
  std::cin.rdbuf(oldCin);
  std::cout.rdbuf(oldCout);

  // 出力を取得
  output = outputBuffer.str();
}

// テストケース
TEST(ProcessInputTest, BasicTest) {
  const std::string input = "1 2 3\nhello";
  const std::string expectedOutput = "6 hello\n";
  std::string actualOutput;

  runWithInputOutput(input, actualOutput);

  EXPECT_EQ(actualOutput, expectedOutput);
}

TEST(ProcessInputTest, AnotherTest) {
  const std::string input = "10 20 30\nworld";
  const std::string expectedOutput = "60 world\n";
  std::string actualOutput;

  runWithInputOutput(input, actualOutput);

  EXPECT_EQ(actualOutput, expectedOutput);
}

int main(int argc, char **argv) {
  ::testing::InitGoogleTest(&argc, argv);
  return RUN_ALL_TESTS();
}
