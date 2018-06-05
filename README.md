# README

## Configuration
```sh
Create parameters.yml file in the app>config folder (based on 'parameters.yml.dist')
```

## Installation

```sh
# Install PHP dependencies
composer install

# Initialiser la base
Vous devez créer une base de données mysql, et indiquer les accès à cette base dans le fichier app.config.parameters.yml

# Installer et mettre à jour la base
php bin/console doctrine:schema:update --force

# Do migrations (inserting datas)
php bin/console doctrine:migrations:migrate
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

## Other commands

```sh
# Generate new entity (take ORM annotations)
php bin/console doctrine:generate:entity

# Generate setter/getter on existing entity
php bin/console doctrine:generate:entities ApiBundle:NameOfYourEntity

# To dump the SQL statements to the screen
php bin/console doctrine:schema:update --dump-sql

# To execute the command
php bin/console doctrine:schema:update --force

# To up a special migration
php bin/console doctrine:migrations:execute 20180604174532 --up

# To down a special migration
php bin/console doctrine:migrations:execute 20180604174532 --down

```

## Resources
# Symfony
https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony

# API rest Symfony
https://openclassrooms.com/courses/construisez-une-api-rest-avec-symfony

# Doctrine association mapping
https://www.doctrine-project.org/projects/doctrine-orm/en/latest/reference/association-mapping.html#many-to-many-bidirectional

# Doctrine migrations
https://symfony.com/doc/master/bundles/DoctrineMigrationsBundle/index.html
