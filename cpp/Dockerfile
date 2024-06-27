# cpp/Dockerfile
FROM gcc:latest

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    cmake \
    git \
    && apt-get clean

# GTestのインストール
RUN git clone https://github.com/google/googletest.git /usr/src/googletest \
    && cd /usr/src/googletest \
    && cmake . \
    && make \
    && make install

WORKDIR /usr/src/app

# 必要なファイルとディレクトリをコピー
COPY src /usr/src/app/src
COPY common /usr/src/app/common
COPY compile_flags.txt /usr/src/app

