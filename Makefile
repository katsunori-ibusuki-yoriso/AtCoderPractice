up:
	docker compose up -d

go-test:
	@echo "Running Go tests..."
	docker exec -it atcoder_go sh \
		-c "go test ."

cpp-test:
	@echo "Running C++ tests..."
	docker exec atcoder_cpp sh \
		-c "cd /usr/src/app && g++ @compile_flags.txt -DTESTING ./src/main.cpp ./src/main_test.cpp -lgtest -lgtest_main -pthread -o test && ./test"

ts-test:
	@echo "Running TypeScript tests..."
	docker exec atcoder_typescript sh \
		-c "cd /usr/src/app && npm install && npx ts-node src/main.test.ts"

php-test:
	@echo "Running PHP tests..."
	docker exec atcoder_php sh \
		-c "cd /usr/src/app && UNIT_TEST=1 vendor/bin/phpunit --configuration phpunit.xml"

rust-test:
	@echo "Running Rust tests..."
	docker exec atcoder_rust bash \
		-c "cd /usr/src/app && cargo test"

ps:
	docker compose ps

build:
	docker compose build

restart:
	docker compose restart

stop:
	docker compose stop

down:
	docker compose down

clean:
	docker compose down --volumes --rmi all
