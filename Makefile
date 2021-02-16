build:
	docker build -t cli .
	docker run -it --rm -v "$(PWD):/var/www" cli composer install

bash:
	docker run -it --rm -v "$(PWD):/var/www" cli bash

