<h1 align="center">
  Login with multiple emails and Google Login in Laravel9 | Vue & DDD & Hexagonal Architecture & Laravel Sail
</h1>

This project extends Laravel authentication to allow login with multiple emails and support <strong>Google login</strong><br>

The application implements the following features and technologies:

- <strong>Google login</strong> functionality with <strong>Laravel Socialite</strong>
- Extension of the EloquentUserProvider class to support <strong>login with multiple emails</strong>
- External API with one endpoint. Protected with API tokens using <strong>Laravel Sanctum</strong>
- Internal API protected with Laravel session authentication
- In the frontend there are developed <strong>Vue.JS</strong> components that consume the internal API
- The API features are decoupled from the framework with <strong>Hexagonal Architecture</strong> and <strong>DDD</strong> concepts
- Project built on a <strong>Docker</strong> development environment through a <strong>Laravel Sail</strong> interaction. [More info](https://laravel.com/docs/9.x/sail)
- Support for users universally unique identifiers (uuid)

## Environment Setup
Laravel version: 9.1.0
### PHP requeriments
1. PHP ^8.0.2


### Needed tools
1. [Install Docker](https://www.docker.com/get-started)
2. [Install Composer](https://getcomposer.org/download/)
3. Clone this project: `git clone https://github.com/adrianRoldan/extended_laravel_login.git`
4. Move to the project folder: `extended_laravel_login`


### Up Environment
1. Run: `composer install`
2. Start your docker
3. Execute `./vendor/bin/sail up` to up containers
4. Configure your .env file with your Google keys to test the Google Login. [Info to create Google Api Keys](https://cloud.google.com/docs/authentication/api-keys)
```dotenv
GOOGLE_ID=
GOOGLE_SECRET=
```


### Application execution

The application runs in the port 80:
http://localhost

--------

### API Endpoint
The following endpoint returns the email domains most used by users. With the optional parameter we can limit the number of returned domains.<br>

When making requests using API tokens, the token should be included in the Authorization header as a Bearer token.<br>
You can obtain the API token in the application user profile (http://localhost/users/{user_id}). <br><br>
The <strong>Api.postman_collection.json</strong> file has the collection of API requests available with the input data to import into [postman](https://www.postman.com/).

##### Endpoint to get email domains most used:
`GET` /api/domains/used <br>

<small>Input parameters:</small>
```http request
max={max_number_of_domains?}
```
<hr>


### Tests execution

1. Run next command to execute tests: `./vendor/bin/sail test`



