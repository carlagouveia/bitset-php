.PHONY: test
test:
	vendor/bin/phpunit
	vendor/bin/phpstan
	vendor/bin/php-cs-fixer check
