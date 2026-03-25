# Instalasi API Hungryhub

## Installing Composer

Prepare composer if you don't have one

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'c8b085408188070d5f52bcfe4ecfbee5f727afa458b2573b8eaaf77b3419b0bf2768dc67c86944da1544f06fa544fd47') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```



put composer.phar in global PATH

```
sudo mv composer.phar /usr/local/bin/composer
```

## Github Clone

Run these command in your terminal

```
git clone https://github.com/awaludinms/hungryhub-api-2026.git
cd hungryhub-api-2026
composer install
cp .env.example .env
```

## Genate Encryption Key

Run this command in terminal to generate encryption key on the app

```
php artisan key:generate
```

## Database

Run MariaDB to create database

```
sudo mysql -u root -p
```

run these command in mysql query line

```
CREATE DATABASE dbhungryhub;
CREATE USER hungryhubuser2@localhost IDENTIFIED BY 'anypassword';
GRANT ALL PRIVILEGES ON dbhungryhub.* TO hungryhubuser2@localhost;
FLUSH PRIVILEGES;
```


Then Open .env and Edit line than contains these

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hungryhub_api_2026
DB_USERNAME=root
DB_PASSWORD=
```


into these

```DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbhungryhub
DB_USERNAME=hungryhubuser2
DB_PASSWORD='anypassword'
```

And save it

## Migrate and Database User, Restaurant and Menu Items' Seed

Run these command for Database Migration and Seeders

```
php artisan migrate
php artisan db:seed
```


## Run Server

Run this command to run api server

```
php artisan serve
```


# Design Desicions

In design decisions I use look like Repository Design, the different is I don't make **interface**.

In this design I use **"Utility"** as a name like RestaurantUtility, MenuItemUtility

I put utilties on **App/Utilites namespace**.

On Every Utility like RestaurantUtility I place a directory inside utilites
like this

```
app/
 ||
 ||==> Utilities/
 ||==> RestaurantUtility.php
 ||==> Restaurant/
       ||
       ||==> RestaurantStore.php
       ||==> RestaurantUpdate.php
       ||==> RestaurantAddMenuItem.php
       ...
  ...
```

Those directory tree is made according to route 
for example

```
POST /restaurants/ --> Create Restaurant
```

so it will be

```
Utilities/Restaurant/RestaurantStore.php
```

This desicision is to make easy to trace the process of API

Below is the code

From Controller to Process in Utility folder/namespace

Controller snippets
File: **RestaurantController.php**
```
...
public function store(RestaurantUtility $utility, RestaurantStore $restaurants, RestaurantStoreRequest $request)
{
        return $utility->store($restaurants, $request);
}
...
```

Utility snippets
File **Utilities/RestaurantUtility.php**
```
...
public function store(RestaurantStore $restaurants, $request)
{
        //
        return($restaurants->store($request));
}
...
```

And finally the Process snippet (only contains one methods)
File: **Utilities/Restaurant/RestaurantStore**
```
...
class RestaurantStore
{
    use CommonResponse;
    /**
     * Create a new class instance.
     */
    public function store($request)
    {
        //
        $validated = $request->validated();
        $validated['created_at'] = date('Y-m-d');

        try {
            $id = Restaurant::insertGetId($validated);

            return $this->success('Restaurant success saved', $validated, $id);

        } catch (\Exception $e) {
            return $this->failed('Restaurant fail to save', $e, $validated);
        }
    }
}
...
```




# API Structure and it's explanation

| Method | API Endpoint                | Description                                           |
| --------| -----------------------------| -------------------------------------------------------|
| POST   | /login                      | Login to get API token                                |
| POST   | /restaurants                | Create a restaurant                                   |
| GET    | /restaurants                | List all restaurants                                  |
| GET    | /restaurants/:id            | Get restaurant detail (include menu items)            |
| PUT    | /restaurants/:id            | Update a restaurant                                   |
| DELETE | /restaurants/:id            | Delete a restaurant                                   |
| POST   | /restaurants/:id/menu_items | Add a menu item                                       |
| GET    | /restaurants/:id/menu_items | List menu items (support filter by category and name) |
| PUT    | /menu_items/:id             | Update a menu item                                    |
| DELETE | /menu_items/:id             | Delete a menu item                                    |




# Run the APIs

This API using sanctum as authentication, to access every API in this app must login first to get **token** that will be placed on header request
"Authentication" : API_TOKEN

## Login to get 

Run this command in terminal

```
curl --request POST \
  --url http://localhost:8000/login \
  --header 'Accept: applcation/json' \
  --header 'content-type: application/json' \
  --data '{
  "email" : "admin@hungryhub.app",
  "password"  : "adminpasssimple123!"
}'
```

it will output like this, (Token value is vary for each request on login, below is on of generated token)

```
{"token":"3|anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139"}
```

The **curl** command will produce **token**, in this example, token value is **anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139**







