docker-start:
	docker-compose up -d

docker-stop:
	@docker-compose down -v

docker-restart: docker-stop docker-start
