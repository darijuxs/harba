# harba

## Setup guide
1. clone git repository
2. go to environment folder
3. install docker and docker-compose
4. run docker-compose up -d
5. add to you hosts file 
    172.18.0.2 harba.local  
    172.18.0.100 db.local
6. open web container *docker exec -it web_harba bash* and got to */var/www/html*
7. install composer (@todo need to add container)  
    https://getcomposer.org/download/  
    https://getcomposer.org/doc/00-intro.md#globally  
8. go to /var/www/html/harba and run composer install
9. got to /etc/apache2/sites-available and run a2ensite harba.local.conf, service apache2 reload (@todo should be run automatically)

10. create database commands:
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console doctrine:migrations:migrate

11. open web container *docker exec -it node_harba bash* and got to */var/www/html*

12. install angule cli npm install -g @angular/cli

13. build angule js application ng build

14. run page http://harba.local

15. go to */var/www/html/harba* and run test *./bin/phpunit*
