use std::io::{self, BufRead, Write};
// Atcoder提出時は下記をコメントアウト
mod main_test;

pub fn process_input<R: BufRead, W: Write>(mut input: R, mut output: W) {
    let mut a = String::new();
    input.read_line(&mut a).unwrap();
    let a: i32 = a.trim().parse().unwrap();

    let mut bc = String::new();
    input.read_line(&mut bc).unwrap();
    let mut bc_iter = bc.split_whitespace();
    let b: i32 = bc_iter.next().unwrap().trim().parse().unwrap();
    let c: i32 = bc_iter.next().unwrap().trim().parse().unwrap();

    let mut s = String::new();
    input.read_line(&mut s).unwrap();
    let s = s.trim();

    let sum = a + b + c;
    writeln!(output, "{} {}", sum, s).unwrap();
}

fn main() {
    let stdin = io::stdin();
    let stdout = io::stdout();
    process_input(stdin.lock(), stdout.lock());
}
