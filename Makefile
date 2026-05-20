.PHONY: help build up down shell test test-unit test-all test-filter logs php composer secret-set secret-list secret-reveal

CONTAINER_PHP = symfony_app
# Docker management
build:
	docker compose build

up:
	docker compose up -d

down:
	docker compose down


shell:
	docker exec -it $(CONTAINER_PHP) bash

# Tests
test-unit:
	docker exec -it $(CONTAINER_PHP) php bin/phpunit --testsuite=Unit

test-all:
	docker exec -it $(CONTAINER_PHP) php bin/phpunit

test-filter:
	docker exec -it $(CONTAINER_PHP) php bin/phpunit --filter=$(F)

test-coverage:
	docker exec -it $(CONTAINER_PHP) php bin/phpunit --coverage-text

#>> Hellpers
logs:
	docker logs $(CONTAINER_PHP) -f
#<< Hellpers

#>> Doctrine
create-database:
	docker  exec $(CONTAINER_PHP) php bin/console doctrine:database:create

drop-database:
	docker  exec $(CONTAINER_PHP) bin/console doctrine:database:drop --force

custom-start:
	docker compose --env-file .env.local up -d

#>>> Secrets management
secret-set:
	@if [ -z "$(VAR)" ]; then \
		echo " Error: VAR is required. Usage: make secret-set VAR=DB_PASSWORD"; \
		exit 1; \
	fi
	@echo "Setting secret: $(VAR)"
	docker exec -it $(CONTAINER_PHP) php bin/console secrets:set $(VAR)

secret-list: ## List all secrets
	docker exec -it $(CONTAINER_PHP) php bin/console secrets:list

secret-reveal: ## Reveal a secret value
	@if [ -z "$(VAR)" ]; then \
		echo "Error: VAR is required. Usage: make secret-reveal VAR=DB_PASSWORD"; \
		exit 1; \
	fi
	@echo "Revealing secret: $(VAR)"
	docker exec -it $(CONTAINER_PHP) php bin/console secrets:reveal $(VAR)
