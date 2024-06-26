import * as fs from 'fs';
import { processInput } from './main';

const INPUT_PATH = '/usr/src/app/common/input/';
const OUTPUT_PATH = '/usr/src/app/common/output/';

function initIO(inputFile: string, outputFile: string): { inputData: string, expectedOutput: string } {
  const inputData = fs.readFileSync(inputFile, 'utf-8');
  const expectedOutput = fs.readFileSync(outputFile, 'utf-8');
  return { inputData, expectedOutput };
}

function closeIO(actualOutput: string, expectedOutput: string): void {
  if (actualOutput !== expectedOutput) {
    throw new Error(`Expected output:\n${expectedOutput}\nBut got:\n${actualOutput}`);
  }
}

function runTest(inputFile: string, outputFile: string): void {
  const input = INPUT_PATH + inputFile;
  const output = OUTPUT_PATH + outputFile;
  const { inputData, expectedOutput } = initIO(input, output);
  const actualOutput = processInput(inputData);
  closeIO(actualOutput, expectedOutput);
  console.log('All tests passed!');
}

runTest('test1.in', 'test1.out');

