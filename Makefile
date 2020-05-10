SHELL := /bin/bash

tests:
	php bin/console doctrine:fixtures:load -n --group=AppFixtures
	php bin/phpunit
.PHONY: tests

start:
	symfony server:start -d
	yarn encore dev --watch

log:
	symfony server:log

git:
	git status
	git add .
	git status

cleanup:
	symfony console app:comment:cleanup