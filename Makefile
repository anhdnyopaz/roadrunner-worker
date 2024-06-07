run_rr:
	docker run --name grpc_server -v $(PWD):/app -w /app --rm -it --entrypoint rr -p 9001:9001 php8.1-laravel-grpc:test serve
run_client:
	docker run -v $(PWD):/app -w /app --rm -it --entrypoint php php8.1-laravel-grpc:test client.php
