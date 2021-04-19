.PHONY: help bash install test

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

bash: ## up containers
	@docker-compose run --rm php bash

install: ## composer install
	@docker-compose run --rm php composer install

test: ## phpunit
	@docker-compose run --rm php composer test

test-coverage-html: ## phpunit coverage html
	@docker-compose run --rm php composer test-coverage-html

test-coverage-text: ## phpunit coverage text
	@docker-compose run --rm php composer test-coverage-text

phpstan: ## composer phpstan
	@docker-compose run --rm php composer phpstan
