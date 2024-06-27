package main

import (
	"bufio"
	"fmt"
	"io"
	"os"
	"strconv"
	"strings"
)

func processInput(input io.Reader, output io.Writer) {
	scanner := bufio.NewScanner(input)

	scanner.Scan()
	a, _ := strconv.Atoi(scanner.Text())

	// 以下を埋めてね
}

func main() {
	processInput(os.Stdin, os.Stdout)
}
