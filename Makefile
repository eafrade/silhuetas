SERVICE=php-app
COMPOSE=docker-compose.yml
DC=docker-compose -f $(COMPOSE)

SHELL := /bin/sh

.PHONY: build check check-running clean coverage down fix help install lint qa run shell sonar stan status test testdox up

help:
	@echo "Available commands:"
	@echo "  make build     - Build image"
	@echo "  make up        - Start container"
	@echo "  make down      - Stop container"
	@echo "  make shell     - Container shell"
	@echo "  make test      - Run PHPUnit tests"
	@echo "  make testdox   - Run PHPUnit in TestDox format"
	@echo "  make coverage  - Generate coverage report"
	@echo "  make install   - Install Composer dependencies"
	@echo "  make lint      - Check PSR12"
	@echo "  make fix       - Fix code"
	@echo "  make stan      - Run PHPStan"
	@echo "  make status    - Check container status"
	@echo "  make run       - Execute the app"
	@echo "  make sonar     - Run SonarQube scan"

build:
	$(DC) build

up:
	$(DC) up --build $(SERVICE) &

down:
	$(DC) down

status:
	@echo "🔍 Checking status of service '$(SERVICE)'..."
	@CID=$$($(DC) ps -q $(SERVICE)); \
	if [ -z "$$CID" ]; then \
		echo "❌ Service '$(SERVICE)' is not running."; \
	else \
		STATUS=$$(docker inspect --format='{{.State.Status}} (health: {{.State.Health.Status}})' $$CID 2>/dev/null || echo "unavailable"); \
		echo "✅ Service '$(SERVICE)' is running: $$STATUS"; \
	fi

check-running:
	@CID=$$($(DC) ps -q $(SERVICE)); \
	if [ -z "$$CID" ]; then \
		echo "❌ Service '$(SERVICE)' is not running. Use 'make up' first."; \
		exit 1; \
	fi; \
	HEALTH=$$(docker inspect --format '{{if .State.Health}}{{.State.Health.Status}}{{else}}none{{end}}' $$CID); \
	if [ "$$HEALTH" = "unhealthy" ]; then \
		echo "❌ Service '$(SERVICE)' is unhealthy."; \
		exit 1; \
	elif [ "$$HEALTH" = "starting" ]; then \
		echo "⏳ Service '$(SERVICE)' is still starting..."; \
		exit 1; \
	elif [ "$$HEALTH" = "none" ]; then \
		echo "⚠️  No healthcheck configured for service '$(SERVICE)' (assuming running)."; \
	else \
		echo "✅ Service '$(SERVICE)' is running and healthy."; \
	fi

shell: check-running
	$(DC) exec $(SERVICE) sh

install: check-running
	$(DC) exec $(SERVICE) composer run install-vendor

run: check-running
	$(DC) exec $(SERVICE) composer run run-app

test: check-running
	$(DC) exec $(SERVICE) composer run test

testdox: check-running
	$(DC) exec $(SERVICE) composer run testdox

coverage: check-running
	$(DC) exec $(SERVICE) composer run coverage
	$(DC) exec $(SERVICE) composer run stan

lint: check-running
	$(DC) exec $(SERVICE) composer run lint

fix: check-running
	$(DC) exec $(SERVICE) composer run fix

stan: check-running
	$(DC) exec $(SERVICE) composer run stan

sonar:
	@echo "🔍 Executando análise SonarQube com o container dedicado..."
	@$(DC) run --rm sonar-scanner
