use super::process_input;
use std::fs::{self, File};
use std::io::{BufReader, Read};
use std::path::Path;

fn read_to_string<P: AsRef<Path>>(path: P) -> String {
    let mut file = File::open(path).expect("Failed to open file");
    let mut content = String::new();
    file.read_to_string(&mut content)
        .expect("Failed to read file");
    content
}

#[test]
fn test_process_input() {
    let input_dir = "/usr/src/app/common/input/A001";
    let output_dir = "/usr/src/app/common/output/A001";
    for entry in fs::read_dir(input_dir).expect("Failed to read input directory") {
        let entry = entry.expect("Failed to get entry");
        let path = entry.path();
        if path.is_file() {
            let file_name = path.file_name().unwrap().to_str().unwrap();
            let input_file = File::open(&path).expect("Failed to open input file");
            let output_file_name = file_name.replace(".in", ".out");
            let output_file_path = Path::new(output_dir).join(output_file_name);
            let expected_output = read_to_string(&output_file_path);

            let reader = BufReader::new(input_file);
            let mut output = Vec::new();
            process_input(reader, &mut output);

            assert_eq!(
                String::from_utf8(output).unwrap(),
                expected_output,
                "Test failed for file: {}",
                file_name
            );
        }
    }
}
