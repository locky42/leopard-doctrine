<?php

namespace Leopard\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use \Exception;

/**
 * Class EntityManager
 * @package Leopard\Doctrine
 */
class EntityManager
{
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
    }
}
