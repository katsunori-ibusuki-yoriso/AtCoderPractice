# rust/Dockerfile
FROM rust:latest

WORKDIR /usr/src/app

# 必要なファイルとディレクトリをコピー
COPY . .

# テストの実行用コマンドを指定
CMD ["cargo", "test"]
