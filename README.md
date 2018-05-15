# README

## Installation

```sh
# Install PHP dependencies
composer install
```

## Configuration
```sh
Create parameters.yml file in the app>config folder (based on 'parameters.yml.dist')
```

## Launching

```sh
# Run API server (foreground)
php bin/console server:run

# Start API server
php bin/console server:start

# Stop API server
php bin/console server:stop

# In order to test the API
go to http://localhost:8000/checkservices

# Consult API doc
go to http://localhost:8000/api/doc
```