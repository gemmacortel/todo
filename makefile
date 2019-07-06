install:
	mkdir -p data/db
	docker-compose up -d
	docker exec -it web docker-php-ext-install mysqli
	docker exec -it web docker-php-ext-enable mysqli
	docker exec -it database mysql -u root -proot -e "CREATE DATABASE notes;"
	docker exec -it database mysql -u root -proot -e "CREATE TABLE notes.todos(task VARCHAR(100), status INT, id VARCHAR(30), PRIMARY KEY (id));"
	docker exec -it web apachectl restart
run:
	docker-compose up -d
	docker exec -it web docker-php-ext-install mysqli
	docker exec -it web docker-php-ext-enable mysqli
	docker exec -it web apachectl restart


