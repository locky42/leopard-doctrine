<?php

namespace Leopard\Doctrine\Listeners;

use Leopard\Doctrine\ResolveTargetEntityRegistry;
use Leopard\Doctrine\Events\BeforeInitEntityManagerEvent;

/**
 * Listener for the BeforeInitEntityManagerEvent that applies ResolveTargetEntity mappings
 * to the Doctrine event manager before the EntityManager is initialized.
 */
class BeforeInitEntityManagerListener
{
    /**
     * Handle the BeforeInitEntityManagerEvent.
     *
     * @param BeforeInitEntityManagerEvent $event
     * @return void
     */
    public function __invoke(BeforeInitEntityManagerEvent $event): void
    {
        if ($event->eventManager) {
            ResolveTargetEntityRegistry::applyMappings($event->eventManager);
        }
    }
}
