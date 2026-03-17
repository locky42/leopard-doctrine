<?php

namespace Leopard\Doctrine\Events;

use Doctrine\Common\EventManagerInterface;

/**
 * Event triggered after the Doctrine EventManager has been initialized.
 * 
 * This event allows listeners to perform actions such as registering
 * ResolveTargetEntity mappings after the EventManager is ready.
 */
class AfterInitEventManagerEvent {
    /**
     * Constructor.
     *
     * @param EventManagerInterface $eventManager The initialized EventManager instance.
     */
    public function __construct(public EventManagerInterface $eventManager) {}
}
