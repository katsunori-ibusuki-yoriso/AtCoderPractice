import * as fs from 'fs';

export function processInput(input: string): string {
  const lines = input.split('\n');
  const a = parseInt(lines[0].trim());
  // 以下を埋めてね

  // 結果をreturnしてください
  // return ;
}

if (require.main === module) {
  const input = fs.readFileSync('/dev/stdin', 'utf-8');
  const output = processInput(input);
  console.log(output);
}

