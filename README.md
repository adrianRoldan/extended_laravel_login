<h1 align="center">
  API without frameworks in PHP | DDD & Hexagonal Architecture
</h1>

This project tries to be a native implementation of an API in PHP. It's decoupled from any framework and only uses PHP-DI as a dependency container.


## Environment Setup

### Needed tools
1. [Install Docker](https://www.docker.com/get-started)
2. [Install Composer](https://getcomposer.org/download/)
3. Clone this project: `git clone https://github.com/adrianRoldan/api-without-frameworks.git api-users-php`
4. Move to the project folder: `cd api-users-php`


### Environment Configuration
1. Run: `cp config/database.example.php config/database.php`
2. Configure database.php file with: 
```dotenv
"host"      => "database"
"user"      => "api"
"pass"      => "api"
"database"  => "api-users"
"port"      => 3306
```
3. Run: `composer install`


### UP Environment

1. Execute `docker-compose build`
2. Execute `docker-compose up -d`

### API execution

The application runs in the port 3000:
http://localhost:3000/

#### API Endpoints
The <strong>postman collection.json</strong> file has the collection of API requests available with the input data to import into [postman](https://www.postman.com/).

###### Create user:
`POST` /user/create/ <br>

<small>Input parameters:</small>
```json
{
    "name" : "name",
    "lastName" : "lastName",
    "phone" :  "phone"
}
```
<hr>

###### Get User Contacts:
`GET` /user/contacts <br>

<small>Input parameters:</small>
```http request
userId=userId
```
<hr>


###### Create user contacts:
`POST` /user/contacts/create <br>

<small>Input parameters:</small>
```json
{
    "userId": 2,
    "contacts": [
        ...
        {
            "contactName": "Paco",
            "phone": 639916718
        },
        {
            "contactName": "Adela",
            "phone": 634716718
        },
        {
            "contactName": "Angel",
            "phone": 639916712
        }
        ...
    ]
}
```
<hr>

###### Update user contacts:
`PUT` /user/contacts/update <br>

<small>Input parameters:</small>
```json
{
    "userId": 1,
    "contacts": [
        {
            "contactName": "Martin",
            "phone": 939916718
        },
        {
            "contactName": "Guillermo",
            "phone": 934512114
        }
    ]
}
```
<hr>


###### Get shared Contacts:
`GET` /user/contacts/common <br>

<small>Input parameters:</small>
```http request
userId1=userId1
userId2=userId2
```


### Tests execution

1. Execute PHPUnit tests: `docker exec api-users-apache-php ./vendor/bin/phpunit`


### Project explanation

This is a simple users API.
Users can have none or many contacts in their address book.


##### Conceptual diagram
<br>
<p align="center">
    <img src="conceptual_model_API_users.png" />
</p>

