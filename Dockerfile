FROM gcc:latest

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
    cmake \
    libgtest-dev

# gtestのビルド
RUN cd /usr/src/gtest && cmake CMakeLists.txt && make && cp *.a /usr/lib

WORKDIR /usr/src/app
