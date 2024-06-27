import * as fs from 'fs';

export function processInput(input: string): string {
  const lines = input.split('\n');
  const a = parseInt(lines[0].trim());
  const [b, c] = lines[1].trim().split(' ').map(Number);
  const s = lines[2].trim();
  const sum = a + b + c;
  return `${sum} ${s}`;
}

if (require.main === module) {
  const input = fs.readFileSync('/dev/stdin', 'utf-8');
  const output = processInput(input);
  console.log(output);
}

