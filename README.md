# Leopard Doctrine

`locky42/leopard-doctrine` integrates Doctrine ORM with Leopard events and provides a registry for `ResolveTargetEntity` mappings.

## Features

- Global wrapper around Doctrine `EntityManager` (`Leopard\Doctrine\EntityManager`)
- `ResolveTargetEntityRegistry` for interface → implementation mappings
- Event-based initialization hooks:
  - `BeforeInitEventManagerEvent`
  - `AfterInitEventManagerEvent`
  - `BeforeInitEntityManagerEvent`
  - `AfterInitEntityManagerEvent`

## Installation

```bash
composer require locky42/leopard-doctrine
```

## Usage

### 1) Configure mappings (optional)

Register interface mappings before `BeforeInitEntityManagerEvent` is dispatched:

```php
use Leopard\Doctrine\ResolveTargetEntityRegistry;
use Leopard\User\Contracts\Models\UserInterface;
use App\Models\User;

ResolveTargetEntityRegistry::addResolveTargetEntity(
    UserInterface::class,
    User::class,
    []
);
```

### 2) Initialize Doctrine and Leopard events

```php
use Doctrine\Common\EventManager as DoctrineEventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager as ORMEntityManager;
use Doctrine\ORM\ORMSetup;
use Leopard\Doctrine\EntityManager;
use Leopard\Doctrine\Events\BeforeInitEntityManagerEvent;
use Leopard\Doctrine\Events\BeforeInitEventManagerEvent;
use Leopard\Doctrine\Events\AfterInitEventManagerEvent;
use Leopard\Events\EventManager as LeopardEventManager;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src/Models'],
    isDevMode: true
);

LeopardEventManager::doEvent(BeforeInitEventManagerEvent::class);

$eventManager = new DoctrineEventManager();

LeopardEventManager::doEvent(AfterInitEventManagerEvent::class, $eventManager);

$connection = DriverManager::getConnection([
    // driver, host, dbname, user, password...
], null, $eventManager);

LeopardEventManager::doEvent(BeforeInitEntityManagerEvent::class);

// Important: pass the same Doctrine EventManager to ORM EntityManager
$ormEntityManager = new ORMEntityManager($connection, $config, $eventManager);

EntityManager::setEntityManager($ormEntityManager);
```

### 3) Retrieve EntityManager anywhere

```php
$em = EntityManager::getEntityManager();
```

## Requirements

- PHP 8.3+
- Doctrine ORM 3.x
- `locky42/leopard-events`

## Notes

- If you use `ResolveTargetEntity`, ensure listeners are attached to the same Doctrine `EventManager` instance that is passed to ORM `EntityManager`.
- The package bootstrap auto-registers internal listeners via Composer autoload files.

## License

MIT
