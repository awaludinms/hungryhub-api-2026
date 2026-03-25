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


## Run Test

Run Test to make sure API is working properly

```
php artisan test
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

With this design, it will be **Clean Code** in controller, **Readable** and **Easy to Maintain**, and **Trace for Debugging**.


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
with "Bearer in front of API_TOKEN" like below

```
`Authorization: Bearer API_TOKEN`
```

e.g in curl use

```
--header 'Authorization: Bearer anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139'
```



Auth:Sanctum protect protects API endpoint both on **routes/web.php** and **routes/api.php**



when API Token not provided it will be status: **401** - Unauthorized

```
{
  "message": "Unauthenticated."
}
```


In this document, I will run API using CURL via terminal

## Login to get API TOKEN
endpoint : **POST /login**

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

response code: **200** - OK

```
{"token":"3|anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139"}
```

The **curl** command will produce **token**, in this example, token value is **anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139**
and it will be put in **Authorization** Header in any protective routes/endpoint

## Create Restaurant
endpoint : **POST /restaurants**

After getting token, 

Run this command in terminal

```
curl --request POST \
  --url http://127.0.0.1:8000/restaurants \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json' \
  --data '{
  "name" : "Restaurant store 23 march 2026",
  "address": "Jogjakarta",
  "phone" : "029309204024024",
  "opening_hours": "13:00-21:00"
}'
```

The response output (after formatted for easy read)
response code: **200** - OK

```
{
   "message":"Restaurant success saved",
   "errors":null,
   "success":true,
   "data":{
       "id":4,
       "name":"Restaurant store 23 march 2026",
       "address":"Jogjakarta",
       "phone":"029309204024024",
       "opening_hours":"13:00-21:00",
       "created_at":"2026-03-25"
    }
}
```

## List Restaurant
endpoint : **POST /restaurants**

Run this command line in terminal

```
curl --request GET \
  --url http://127.0.0.1:8000/restaurants \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json' \
  --data '{
  "name" : "Restaurant 1",
  "address": "Jogja"
}'
```


The output
```
{
  "current_page": 1,
  "data": [
    {
      "id": 1,
      "name": "Restoran Nasi Padang",
      "address": "Jl. Kaliurang Yogyakarta",
      "phone": "081309290249",
      "opening_hours": "08:00-16:00 WIB",
      "created_at": "2026-03-25T00:13:13.000000Z",
      "updated_at": null
    },
    {
      "id": 2,
      "name": "Mie Ayam Bakso Pak Awal",
      "address": "Jl. Bantul Yogyakarta",
      "phone": "0813092909000",
      "opening_hours": "09:00-21:00 WIB",
      "created_at": "2026-03-25T00:13:13.000000Z",
      "updated_at": null
    },
    {
      "id": 3,
      "name": "Restaurant store 23 march 2026",
      "address": "Jogjakarta",
      "phone": "029309204024024",
      "opening_hours": "13:00-21:00",
      "created_at": "2026-03-25T00:00:00.000000Z",
      "updated_at": null
    },
    {
      "id": 4,
      "name": "Restaurant store 23 march 2026",
      "address": "Jogjakarta",
      "phone": "029309204024024",
      "opening_hours": "13:00-21:00",
      "created_at": "2026-03-25T00:00:00.000000Z",
      "updated_at": null
    }
  ],
  "first_page_url": "http://127.0.0.1:8000/restaurants?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/restaurants?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/restaurants?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/restaurants",
  "per_page": 10,
  "prev_page_url": null,
  "to": 4,
  "total": 4
}
```

## Update Restaurant Data
enpoint: **PUT /restaurants/:id**

```
curl --request PUT \
  --url http://127.0.0.1:8000/restaurants/4 \
  --header 'Accept: applcation/json' \
  --header 'content-type: application/json' \
  --data '{
  "name" : "Restaurant Updated",
  "address": "Jogja Bantul",
  "phone" : "111111100001111",
  "opening_hours": "19:00-23:00"
}'
```

output:
status code: **200** - Ok
```
{
  "message": "Restaurant success update",
  "errors": null,
  "success": true,
  "data": {
    "id": 4,
    "name": "Restaurant Updated",
    "address": "Jogja Bantul",
    "phone": "111111100001111",
    "opening_hours": "19:00-23:00",
    "updated_at": "2026-03-25"
  }
}
```

## Add Menu Item
enpoint: **POST /restaurants/:id/menu_items**/


```
curl --request POST \
  --url http://127.0.0.1:8000/restaurants/4/menu_items \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json' \
  --data '{
  "name" : "Nasi Goreng Pedas",
  "price": "123400.01",
  "category": "main",
  "is_available": true
}'
```

output: status **200** - Ok

```
{
  "message": "Menu Item success saved",
  "errors": null,
  "success": true,
  "data": {
    "id": 12,
    "name": "Nasi Goreng Pedas",
    "price": "123400.01",
    "category": "main",
    "is_available": 1,
    "created_at": "2026-03-25",
    "restaurant_id": 4
  }
}
```

## Restaurant's Detail
enpoint: **GET /restaurants/:id**

```
curl --request GET \
  --url http://127.0.0.1:8000/restaurants/4 \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json'
```

output: status **200** - Ok

```
{
  "data": [
    {
      "id": 4,
      "name": "Restaurant Updated",
      "address": "Jogja Bantul",
      "phone": "111111100001111",
      "opening_hours": "19:00-23:00",
      "created_at": "2026-03-25T00:00:00.000000Z",
      "updated_at": "2026-03-25T00:00:00.000000Z",
      "menu_item": [
        {
          "id": 12,
          "name": "Nasi Goreng Pedas",
          "description": "",
          "price": 123400.01,
          "category": "main",
          "is_available": 1,
          "restaurant_id": 4,
          "created_at": "2026-03-25T00:00:00.000000Z",
          "updated_at": null
        }
      ]
    }
  ]
}
```

## Menu List on Restaurant
can filter by category and name with wildcards
enpoint: **GET /restaurants/:id/menu_items**

Example using category filter
```
curl --request GET \
  --url 'http://127.0.0.1:8000/restaurants/4/menu_items?category=main' \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer 3|anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json'
```

output
```
{
  "current_page": 1,
  "data": [
    {
      "id": 13,
      "name": "Nasi Goreng Pedas",
      "description": "",
      "price": 123400.01,
      "category": "main",
      "is_available": 1,
      "restaurant_id": 4,
      "created_at": "2026-03-25T00:00:00.000000Z",
      "updated_at": null
    }
  ],
  "first_page_url": "http://127.0.0.1:8000/restaurants/4/menu_items?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/restaurants/4/menu_items?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/restaurants/4/menu_items?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/restaurants/4/menu_items",
  "per_page": 10,
  "prev_page_url": null,
  "to": 1,
  "total": 1
}
```


Example using name filter

```
curl --request GET \
  --url 'http://127.0.0.1:8000/restaurants/4/menu_items?name=Nasi' \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer 3|anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json'
```

```
{
  "current_page": 1,
  "data": [
    {
      "id": 13,
      "name": "Nasi Goreng Pedas",
      "description": "",
      "price": 123400.01,
      "category": "main",
      "is_available": 1,
      "restaurant_id": 4,
      "created_at": "2026-03-25T00:00:00.000000Z",
      "updated_at": null
    }
  ],
  "first_page_url": "http://127.0.0.1:8000/restaurants/4/menu_items?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "http://127.0.0.1:8000/restaurants/4/menu_items?page=1",
  "links": [
    {
      "url": null,
      "label": "&laquo; Previous",
      "page": null,
      "active": false
    },
    {
      "url": "http://127.0.0.1:8000/restaurants/4/menu_items?page=1",
      "label": "1",
      "page": 1,
      "active": true
    },
    {
      "url": null,
      "label": "Next &raquo;",
      "page": null,
      "active": false
    }
  ],
  "next_page_url": null,
  "path": "http://127.0.0.1:8000/restaurants/5/menu_items",
  "per_page": 10,
  "prev_page_url": null,
  "to": 1,
  "total": 1
}
```


## Update Menu
endpoint: **PUT /menu_items/:id**

```
curl --request PUT \
  --url http://127.0.0.1:8000/menu_items/12 \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json' \
  --data '{
  "name" : "Nasi uduk",
  "description" : "Enak",
  "price": "1311411234.01",
  "category": "main",
  "is_available": true
}'
```

output: status: **200** - Ok

```
{
  "message": "Menu Item success update",
  "errors": null,
  "success": true,
  "data": {
    "id": 12,
    "name": "Nasi uduk",
    "description": "Enak",
    "price": "1311411234.01",
    "category": "main",
    "is_available": true,
    "updated_at": "2026-03-25"
  }
}
```

## Delete Menu
endpoint: **DELETE /menu_items/:id**

```
curl --request DELETE \
  --url http://127.0.0.1:8000/menu_items/12 \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json' \
  --data '{
  "name" : "Restaurant 1",
  "address": "Jogja"
}'
```

output
status code: **200** - OK

```
{
  "message": "MenuItem is successfully removed",
  "errors": null,
  "success": true,
  "data": {
    "id": 12
  }
}
```

## Delete Restaurant
endpoint: **DELETE /restaurans/:id**

```
curl --request DELETE \
  --url http://127.0.0.1:8000/restaurants/4 \
  --header 'Accept: applcation/json' \
  --header 'Authorization: Bearer anqg0iBoG4cHmv4sgmGXqxHFop6PJXJmY4vuHJHscca83139' \
  --header 'content-type: application/json' \
  --data '{
  "name" : "Restaurant 1",
  "address": "Jogja"
}'
```

ouput:
status code: **200** - OK

```
{
  "message": "Restaurant is successfully removed",
  "errors": null,
  "success": true,
  "data": {
    "id": 4
  }
}
```

