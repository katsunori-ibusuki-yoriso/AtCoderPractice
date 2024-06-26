#include <algorithm>
#include <iostream>
#include <string>

void processInput() {
  std::string line;
  while (std::getline(std::cin, line)) {
    std::transform(line.begin(), line.end(), line.begin(), ::toupper);
    std::cout << line << std::endl;
  }
}
