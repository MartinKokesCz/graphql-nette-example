<?php

namespace App\Model\Database\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * @template TEntityClass of object
 * @extends EntityRepository<TEntityClass>
 */
abstract class AbstractRepository extends EntityRepository
{
	public function __construct(EntityManagerInterface $em, ClassMetadata $class)
	{
		parent::__construct($em, $class);
	}
}
