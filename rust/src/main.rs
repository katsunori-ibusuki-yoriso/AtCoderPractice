use std::io::{self, BufRead, Write};
// Atcoder提出時は下記をコメントアウト
mod main_test;

pub fn process_input<R: BufRead, W: Write>(mut input: R, mut output: W) {
    let mut a = String::new();
    input.read_line(&mut a).unwrap();
    let a: i32 = a.trim().parse().unwrap();

    //以下を埋めてね
}

fn main() {
    let stdin = io::stdin();
    let stdout = io::stdout();
    process_input(stdin.lock(), stdout.lock());
}
