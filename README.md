
# Laravel API Gateway

Laravel API Gateway is a powerful package designed to facilitate the management and routing of API requests in your Laravel application. It provides features such as header manipulation, authentication, and request forwarding.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Routing](#routing)
  - [Header Manipulation](#header-manipulation)
  - [Authentication](#authentication)
- [Example](#example)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Features

- Route API requests to different endpoints.
- Manipulate request and response headers.
- Support for multiple authentication methods.
- Easy integration with existing Laravel applications.

## Installation

You can install the package via Composer:

```bash
git clone https://github.com/oixan/laravel_api_gateway.git
```


## Configuration

### Configuring Routes

In your `config/apigateway.php`, you can define the routes for your API Gateway:

```php
return [
    'routes' => [
        [
            'prefix' => '/service1',
            'method' => 'GET',
            'service_url' => 'https://api.restful-api.dev',
            'timeout' => 5000,
            'auth' => 'none',
        ],
        // Add more routes as needed
    ],
];
```

## Usage

### Start Laravel Development Server

To start the Laravel development server, run the following command:

```bash
php artisan serve
```

You can now access your API Gateway at `http://localhost:8000/api`.

### Testing with Postman

You can test your API Gateway using Postman. Make a request to the appropriate endpoint, e.g., `http://localhost:8000/api/service1`, and it will be routed through the gateway.


## Contributing

Contributions are welcome! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add some feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Create a new Pull Request.

## License

This package is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
