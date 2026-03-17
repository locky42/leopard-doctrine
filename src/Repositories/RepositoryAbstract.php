<?php

namespace Leopard\Doctrine\Repositories;

use Leopard\Doctrine\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RepositoryAbstract
 * @package Leopard\Doctrine\Repositories
 */
abstract class RepositoryAbstract
{
    /** @var EntityManagerInterface */
    protected EntityManagerInterface $entityManager;

    /**
     * RepositoryAbstract constructor.
     * Initializes the repository with the EntityManager.
     */
    public function __construct()
    {
        $this->entityManager = EntityManager::getEntityManager();
    }
}
