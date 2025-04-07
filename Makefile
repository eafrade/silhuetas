SERVICE=php-app
COMPOSE=docker-compose.yml
DC=docker-compose -f $(COMPOSE)

.PHONY: help build up down shell test coverage install check lint fix stan status

help:
	@echo "Available commands:"
	@echo "  make build     - Build image"
	@echo "  make up        - Start container"
	@echo "  make down      - Stop container"
	@echo "  make shell     - Container shell"
	@echo "  make test      - Run PHPUnit tests"
	@echo "  make coverage  - Coverage Report"
	@echo "  make install   - Install Composer dependencies"
	@echo "  make lint      - Check PSR12"
	@echo "  make fix       - Fix code"
	@echo "  make stan      - Run PHPStan"
	@echo "  make status    - Check container status"
	@echo "  make run       - Execute the app"

build:
	$(DC) build

up:
	$(DC) up --build &

down:
	$(DC) down

shell:
	$(DC) exec $(SERVICE) bash

test:
	$(DC) exec $(SERVICE) ./vendor/bin/phpunit

coverage:
	$(DC) exec $(SERVICE) composer run coverage

install:
	$(DC) exec $(SERVICE) composer install --no-interaction --prefer-dist

lint:
	$(DC) exec $(SERVICE) composer run lint

fix:
	$(DC) exec $(SERVICE) composer run fix

stan:
	$(DC) exec $(SERVICE) composer run stan

run:
	$(DC) exec $(SERVICE) php process.php

status:
	@echo "🔍 Checking status of service '$(SERVICE)'..."
	@CID=$$($(DC) ps -q $(SERVICE)); \
	if [ -z "$$CID" ]; then \
		echo "❌ Service '$(SERVICE)' is not running."; \
	else \
		STATUS=$$(docker inspect --format='{{.State.Status}} (health: {{.State.Health.Status}})' $$CID 2>/dev/null || echo "unavailable"); \
		echo "✅ Service '$(SERVICE)' is running: $$STATUS"; \
	fi
