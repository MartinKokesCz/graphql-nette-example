stan:
	php vendor/bin/phpstan analyse -c phpstan.neon --memory-limit=512M app

cs:
	php vendor/bin/phpcs app

cbf:
	php vendor/bin/phpcbf app