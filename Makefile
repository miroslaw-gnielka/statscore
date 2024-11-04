USERID=$(shell id -u)
USERGROUP=$(shell id -g)

up:
	docker-compose up -d

composer:
	docker run --rm --interactive --tty --volume ./:/app --user ${USERID}:${USERGROUP} composer install

run-tests:
	docker-compose exec --user ${USERID}:${USERGROUP} php-fpm ./vendor/bin/phpunit

run-all: up composer run-tests
