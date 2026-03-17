<?php

namespace Leopard\Doctrine\Events;

use Doctrine\Common\EventManager;

class BeforeInitEntityManagerEvent
{
	/**
	 * Doctrine event manager instance passed in bootstrap.
	 * Declared to avoid creation of dynamic properties on the event object.
	 */
	public ?EventManager $eventManager = null;
}
