# Makefile for BE-Clothing Docker Management

up:
	docker-compose up -d --build

down:
	docker-compose down

logs:
	docker-compose logs -f

app-shell:
	docker-compose exec app bash

mysql:
	docker-compose exec db mysql -u clothing_user -pclothing_password clothing_db

phpmyadmin:
	@echo "Open http://localhost:9091 in your browser."

restart:
	docker-compose down && docker-compose up -d --build

ps:
	docker-compose ps

# Force cleanup - stops all containers and removes them
force-cleanup:
	@echo "Stopping all Docker containers..."
	-docker stop $$(docker ps -aq) 2>/dev/null || true
	@echo "Removing all Docker containers..."
	-docker rm $$(docker ps -aq) 2>/dev/null || true
	@echo "Cleanup complete."

# Safe restart - cleanup first, then start
safe-restart: force-cleanup up
