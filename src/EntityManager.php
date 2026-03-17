<?php

namespace Leopard\Doctrine;

use Leopard\Events\EventManager;
use Leopard\Doctrine\Events\AfterInitEntityManagerEvent;
use Doctrine\ORM\EntityManagerInterface;
use \Exception;

/**
 * Class EntityManager
 * @package Leopard\Doctrine
 */
class EntityManager
{
    /**
     * @var bool $isInitialized
     */
    protected static bool $isInitialized = false;

    /**
     * @var EntityManagerInterface
     */
    protected static EntityManagerInterface $entityManager;

    /**
     * @return EntityManagerInterface
     * @throws Exception
     */
    public static function getEntityManager(): EntityManagerInterface
    {
        if (!isset(self::$entityManager)) {
            throw new Exception('EntityManager not set.');
        }

        return self::$entityManager;
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return void
     */
    public static function setEntityManager(EntityManagerInterface $entityManager): void
    {
        self::$entityManager = $entityManager;

        if (!self::$isInitialized) {
            // Apply any ResolveTargetEntity mappings collected by packages
            // before firing AfterInitEntityManagerEvent so Doctrine metadata
            // resolution knows about interface -> implementation mappings.
            EventManager::doEvent(AfterInitEntityManagerEvent::class);
            self::$isInitialized = true;
        }
    }
}
