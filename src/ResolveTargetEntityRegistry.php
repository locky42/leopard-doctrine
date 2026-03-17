<?php

namespace Leopard\Doctrine;

use Doctrine\Common\EventManager;

/**
 * Class ResolveTargetEntityRegistry
 * @package Leopard\Doctrine
 */
class ResolveTargetEntityRegistry
{
    protected static array $mappings = [];

    /**
     * Add a mapping from an interface to a concrete implementation.
     *
     * @param string $interface The interface class name
     * @param string $implementation The concrete implementation class name
     * @param array $mapping Optional additional mapping information (e.g. cascade, fetch)
     */
    public static function addResolveTargetEntity(string $interface, string $implementation, array $mapping = []): void
    {
        self::$mappings[$interface] = ['implementation' => $implementation, 'mapping' => $mapping];
    }

    /**
     * Get all registered mappings.
     *
     * @return array
     */
    public static function getMappings(): array
    {
        return self::$mappings;
    }

    /**
     * Get the mapping for a specific interface.
     *
     * @param string $interface The interface class name
     * @return array|null Returns the mapping information or null if not found
     */
    public static function getMappingForInterface(string $interface): ?array
    {
        return self::$mappings[$interface] ?? null;
    }

    /**
     * Apply all registered mappings to the given EventManager.
     *
     * @param EventManager $eventManager
     */
    public static function applyMappings(EventManager $eventManager): void
    {
        if (empty(self::$mappings)) {
            return;
        }

        $listener = new \Doctrine\ORM\Tools\ResolveTargetEntityListener();

        foreach (self::$mappings as $interface => $data) {
            $listener->addResolveTargetEntity($interface, $data['implementation'], $data['mapping']);
        }

        $eventManager->addEventSubscriber($listener);
    }
}
