<?php declare(strict_types = 1);

namespace App\Model\Database;

use App\Model\Database\Entity\Book;
use App\Model\Database\Repository\BookRepository;


/**
 * @mixin EntityManager
 */
trait TRepositories
{
	public function getBookRepository(): BookRepository
	{
		return $this->getRepository(Book::class);
	}
}
