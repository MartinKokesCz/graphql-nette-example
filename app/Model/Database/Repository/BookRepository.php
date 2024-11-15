<?php

namespace App\Model\Database\Repository;

use App\Model\Database\Entity\Book;

/**
 * @method Book|null find($id, ?int $lockMode = null, ?int $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method array<Book> findAll()
 * @method array<Book> findBy(array $criteria, array $orderBy = null, ?int $limit = null, ?int $offset = null)
 * @extends AbstractRepository<Book>
 */
final class BookRepository extends AbstractRepository
{
}
