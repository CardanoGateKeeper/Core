export COMPOSE_PROJECT_NAME=gatekeeper
export COMPOSE_FILE=docker/docker-compose.yml

.PHONY: up
up:
	$(MAKE) down
	docker-compose up -d
	$(MAKE) composer-install
	./docker/wait-for-mysql.sh
	$(MAKE) db-migrate
	docker exec -it gatekeeper-web bash -c "npm install"

.PHONY: down
down:
	docker-compose down --remove-orphans

.PHONY: build
build:
	docker-compose build
	$(MAKE) up

#
# Helper functions
#

.PHONY: composer-install
composer-install:
	docker exec -it gatekeeper-web bash -c "composer install"

.PHONY: db-migrate
db-migrate:
	docker exec -it gatekeeper-web bash -c "php artisan migrate"

.PHONY: db-refresh
db-refresh:
	docker exec -it gatekeeper-web bash -c "php artisan migrate:fresh --seed"

.PHONY: tinker
tinker:
	docker exec -it gatekeeper-web bash -c "php artisan tinker"

.PHONY: status
status:
	docker-compose ps

.PHONY: logs
logs:
	docker-compose logs -f --tail=100

.PHONY: shell
shell:
	docker exec -it gatekeeper-web bash

.PHONY: stats
stats:
	docker stats gatekeeper-web gatekeeper-mysql gatekeeper-redis

.PHONY: artisan
artisan:
	docker exec -it gatekeeper-web bash -c "php artisan $(COMMAND)"

.PHONY: admin
admin:
	docker exec -it gatekeeper-web bash -c "php artisan create:admin"

.PHONY: staff
staff:
	docker exec -it gatekeeper-web bash -c "php artisan create:staff"

.PHONY: change-password
change-password:
	docker exec -it gatekeeper-web bash -c "php artisan change:password"
