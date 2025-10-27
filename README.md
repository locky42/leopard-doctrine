# Leopard Doctrine

Leopard Doctrine is a library designed to enhance your Doctrine ORM experience with additional features and utilities.

## Features

- Simplified entity management.
- Advanced query builders.
- Performance optimizations for Doctrine ORM.

## Installation

Install the package via Composer:

```bash
composer require locky42/leopard-doctrine
```

## Usage

Import the library into your project and start using its features:

```php
use Leopard\Doctrine\EntityManager;
use Doctrine\ORM\EntityManager as ORMEntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [...],
    isDevMode: true
);

$connection = DriverManager::getConnection([
    ...
]);

$entityManager = new ORMEntityManager($connection, $config);
$entityManagerProvider = new SingleManagerProvider($entityManager);

EntityManager::setEntityManager($entityManager);

...

$entityManager = EntityManager::getEntityManager();
```

## Requirements

- PHP 8.0 or higher
- Doctrine ORM 2.10 or higher

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.
