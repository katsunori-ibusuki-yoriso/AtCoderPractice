import * as fs from 'fs';

export function processInput(input: string): string {
  return input.toUpperCase();
}

if (require.main === module) {
  const input = fs.readFileSync('/dev/stdin', 'utf-8');
  const output = processInput(input);
  console.log(output);
}

