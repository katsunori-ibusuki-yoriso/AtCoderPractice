import * as fs from 'fs';
import { processInput } from './main';

const INPUT_DIR = '/usr/src/app/common/input/A001/';
const OUTPUT_DIR = '/usr/src/app/common/output/A001/';

function initIO(inputFile: string, outputFile: string): { inputData: string, expectedOutput: string } {
  const inputData = fs.readFileSync(inputFile, 'utf-8');
  const expectedOutput = fs.readFileSync(outputFile, 'utf-8').trim();
  return { inputData, expectedOutput };
}

function closeIO(actualOutput: string, expectedOutput: string): void {
  if (actualOutput !== expectedOutput) {
    console.error('Test failed!');
    console.error('Expected:');
    console.error(expectedOutput);
    console.error('Actual:');
    console.error(actualOutput);
    process.exit(1);
  }
}

function runTest(inputFile: string, outputFile: string): void {
  const input = INPUT_DIR + inputFile;
  const output = OUTPUT_DIR + outputFile;
  const { inputData, expectedOutput } = initIO(input, output);
  const actualOutput = processInput(inputData).trim();
  closeIO(actualOutput, expectedOutput);
}

function runAllTests(): void {
  const inputFiles = fs.readdirSync(INPUT_DIR).filter(file => file.endsWith('.in'));
  inputFiles.forEach(inputFile => {
    const outputFile = inputFile.replace('.in', '.out');
    console.log(`Running test for ${inputFile}...`);
    runTest(inputFile, outputFile);
  });
  console.log('All tests passed!');
}

runAllTests();

