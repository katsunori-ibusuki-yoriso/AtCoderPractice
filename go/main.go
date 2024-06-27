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

	scanner.Scan()
	bc := strings.Split(scanner.Text(), " ")
	b, _ := strconv.Atoi(bc[0])
	c, _ := strconv.Atoi(bc[1])

	scanner.Scan()
	s := scanner.Text()

	fmt.Fprintf(output, "%d %s\n", a+b+c, s)
}

func main() {
	processInput(os.Stdin, os.Stdout)
}
