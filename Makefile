SHELL := /bin/bash

tests:
	php bin/console doctrine:fixtures:load -n --group=AppFixtures
	php bin/phpunit
.PHONY: tests