#include <iostream>

void processInput() {
  int a, b, c;
  std::string s;

  std::cin >> a >> b >> c;
  std::cin.ignore(); // ignore the newline after reading c
  std::getline(std::cin, s);

  int sum = a + b + c;
  std::cout << sum << " " << s << std::endl;
}

#ifndef TESTING
int main() {
  processInput();
  return 0;
}
#endif
