DOCKER_DIR            = .docker
DOCKER_COMPOSE        = cd $(DOCKER_DIR) && docker-compose

EXEC_PHP_CONTAINER    = ${DOCKER_DIR}/bin/docker-php
EXEC_APACHE_CONTAINER = ${DOCKER_DIR}/bin/docker-apache
ECHO                  = ${DOCKER_DIR}/bin/display-job-title

NPM                   = $(EXEC_PHP_CONTAINER) npm
SYMFONY               = $(EXEC_PHP_CONTAINER) bin/console

##
## Environment
## -----------
##

project-install: docker-build dev-start composer-install npm assets-dev db-reset cache-clear assets-install ## Install the project and start the dev environment

project-remove: docker-kill ## Stop the dev environment and remove generated files
	$(ECHO) "Removing files"
	sudo chmod -R 777 ../ramty
	rm -rf vendor var node_modules

project-reinstall: project-remove project-install ## Destroy the dev environment, run a fresh install of the project, then start the dev environment

dev-start: ## Start the dev environment
	$(ECHO) "Starting docker"
	$(DOCKER_COMPOSE) up -d --remove-orphans --no-recreate

dev-stop: ## Stop the dev environment
	$(ECHO) "Stopping docker"
	$(DOCKER_COMPOSE) down

dev-restart: dev-stop dev-start ## Restart the dev environment

##
## Data
## ----
##

db-reset: wait-for-db ## Reset Symfony database with default data
	$(ECHO) "Loading Symfony database"
	$(SYMFONY) doctrine:database:drop --force --if-exists
	$(SYMFONY) doctrine:database:create
	$(SYMFONY) doctrine:schema:create

db-make-migration: wait-for-db ## Reset Symfony database with default data
	$(ECHO) "Creating migration"
	$(SYMFONY) make:migration

db-migrate: wait-for-db ## Reset Symfony database with default data
	$(ECHO) "Migrating"
	$(SYMFONY) doctrine:migrations:migrate

db-fixtures: db-reset ## Reset Symfony database with default data
	$(ECHO) "Generate fixtures"
	$(SYMFONY) doctrine:fixtures:load --no-interaction
##
## Symfony
## -------

cache-clear: ## Clear Symfony cache
	$(ECHO) "Clearing Symfony cache"
	$(SYMFONY) cache:clear --no-warmup

##
## Assets
##-------

npm: ## Update npm packages
	$(ECHO) "Installing npm"
	$(NPM) install

assets-install: ## Install the assets
	$(ECHO) "Installing assets"
	$(SYMFONY) assets:install

assets-watch: node_modules ## Watch the assets and build their development version on file change
	$(ECHO) "Watching assets changes"
	$(NPM) run watch

assets-dev: node_modules ## Build the development version of the assets
	$(ECHO) "Building dev assets"
	$(NPM) run dev

assets-prod: node_modules ## Build the production version of the assets
	$(ECHO) "Building prod assets"
	$(NPM) run build


##
## Quality
## -------
##

cs-fixer: php-cs-fixer ## Apply php-cs-fixer
	$(ECHO) "Running php-cs-fixer"
	$(EXEC_PHP_CONTAINER) php php-cs-fixer fix --config=.php_cs.dist -v --using-cache=no

tests: ## Run unit tests
	$(ECHO) "Running tests"
	$(EXEC_PHP_CONTAINER) bin/phpunit

symfony-security: ## Check security of your dependencies (https://security.sensiolabs.org/)
	$(ECHO) "Checking Symfony vendor security"
	$(EXEC_PHP_CONTAINER) ./bin/console security:check

phpstan: ## Run phpstan
	$(ECHO) "Running phpstan"
	$(EXEC_PHP_CONTAINER) vendor/bin/phpstan analyse

##
## Debug
## -----
##

apache-error-log: ## Display the last entries from Apache error log
	$(ECHO) "Displaying in real time last entries from Apache error log" "Use CTRL+C to close the process"
	$(EXEC_APACHE_CONTAINER) tail -f /var/log/httpd-error.log

apache-access-log: ## Display the last entries from Apache access log
	$(ECHO) "Displaying last entries from Apache access log" "Use CTRL+C to close the process"
	$(EXEC_APACHE_CONTAINER) tail -f /var/log/httpd-access.log

##
#
# Internal rules
# --------------
#

composer-install:
	$(ECHO) "Installing Symfony vendors"
	$(EXEC_PHP_CONTAINER) composer install

docker-build:
	$(ECHO) "Building docker"
	$(DOCKER_COMPOSE) build --pull

docker-kill:
	$(ECHO) "Killing docker"
	$(DOCKER_COMPOSE) kill
	$(DOCKER_COMPOSE) down --volumes --remove-orphans

download-php-cs-fixer:
	$(ECHO) "Downloading php-cs-fixer"
	$(EXEC_PHP_CONTAINER) curl -L http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -o php-cs-fixer

php-cs-fixer:
	$(ECHO) "Downloading php-cs-fixer"
	$(EXEC) curl -L http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -o php-cs-fixer
	$(EXEC) touch $@

wait-for-db:
	$(ECHO) "Waiting for db"
	$(DOCKER_DIR)/bin/wait-for-db

.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
