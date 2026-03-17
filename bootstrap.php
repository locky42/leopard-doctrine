<?php

use Leopard\Events\EventManager;
use Leopard\Doctrine\Events\BeforeInitEntityManagerEvent;
use Leopard\Doctrine\Events\AfterInitEventManagerEvent;
use Leopard\Doctrine\Listeners\BeforeInitEntityManagerListener;

/**
 * This bootstrap file sets up the necessary event listeners for the Leopard Doctrine package.
 * It registers a listener for the BeforeInitEntityManagerEvent to apply ResolveTargetEntity mappings
 * before the EntityManager is initialized.
 */
EventManager::addEvent(
    BeforeInitEntityManagerEvent::class,
    new BeforeInitEntityManagerListener(),
    999999
);

EventManager::addEvent(
    AfterInitEventManagerEvent::class,
    function ($event) {
        $eventManager = $event->eventManager;
        EventManager::addEvent(
            BeforeInitEntityManagerEvent::class,
            function ($event) use ($eventManager) {
                $event->eventManager = $eventManager;
            }
        );
    }
);
