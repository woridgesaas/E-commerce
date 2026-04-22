.PHONY: help build up down shell test test-unit test-all test-filter logs php composer

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
