<?php declare(strict_types = 1);

namespace App\Model\Database;

use App\Model\Database\Repository\AbstractRepository;
use Doctrine\ORM\Decorator\EntityManagerDecorator;
use Doctrine\Persistence\ObjectRepository;

class EntityManager extends EntityManagerDecorator
{

	use TRepositories;

	/**
	 * @return AbstractRepository<T>|ObjectRepository<T>
	 * @internal
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 * @phpstan-template T of object
	 * @phpstan-param class-string<T> $entityName
	 * @phpstan-return ObjectRepository<T>
	 */
	public function getRepository(mixed $entityName): ObjectRepository
	{
		return parent::getRepository($entityName);
	}

	/**
	 */
	public function isUninitializedObject(mixed $value): bool
	{
		return false;
	}
}
