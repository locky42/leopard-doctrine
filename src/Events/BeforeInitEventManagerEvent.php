<?php

namespace Leopard\Doctrine\Events;

/**
 * Event triggered before the Doctrine EventManager is initialized.
 * 
 * This event allows listeners to perform actions such as setting up
 * ResolveTargetEntity mappings before the EventManager is ready.
 */
class BeforeInitEventManagerEvent {}
