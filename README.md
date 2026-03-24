### Instalasi API Hungryhub

Prepare composer if you don't have one

```php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"```

```php -r "if (hash_file('sha384', 'composer-setup.php') === 'c8b085408188070d5f52bcfe4ecfbee5f727afa458b2573b8eaaf77b3419b0bf2768dc67c86944da1544f06fa544fd47') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"```

```php composer-setup.php```
```php -r "unlink('composer-setup.php');"```

put composer.phar in global PATH

```sudo mv composer.phar /usr/local/bin/composer```

Run these command in your terminal

```$ git clone https://github.com/awaludinms/hungryhub-api-2026.git```
```$ cd hungryhub-api-2026```
```composer install```
```cp .env.example .env```

Run MariaDB to create database
```$ sudo mysql -u root -p```

run these command in mysql query line

```CREATE DATABASE dbhungryhub;```
```CREATE USER hungryhubuser2@localhost IDENTIFIED BY 'anypassword';```
```GRANT ALL PRIVILEGES ON dbhungryhub.* TO hungryhubuser2@localhost```
```FLUSH PRIVILEGES```


Then Open .env and Edit line than contains these

```DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hungryhub_api_2026
DB_USERNAME=root
DB_PASSWORD=```

into these

```DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbhungryhub
DB_USERNAME=hungryhubuser2
DB_PASSWORD='anypassword'```

And save it

