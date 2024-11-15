<?php

namespace App\GraphQL\Resolvers;

use App\Model\Database\Entity\Book;
use App\Model\Database\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;

class BookResolver
{
	private BookRepository $bookRepository;

	private EntityManagerInterface $entityManager;

	/**
	 * BookResolver constructor.
	 *
	 * @param BookRepository $bookRepository The repository for Book entity operations
	 * @param EntityManagerInterface $entityManager The Doctrine entity manager
	 */
	public function __construct(BookRepository $bookRepository, EntityManagerInterface $entityManager)
	{
		$this->bookRepository = $bookRepository;
		$this->entityManager = $entityManager;
	}

	/**
	 * Resolver for fetching a single book by its ID.
	 *
	 * @param mixed $root The root object (unused)
	 * @param array<string,int> $args The arguments for finding a book (id)
	 * @return array<string,int|string|null>|null The found Book entity, or null if not found
	 */
	public function resolveBook(mixed $root, array $args): ?array
	{
		// Fetch the book by ID
		return $this->bookRepository->find($args['id'])?->toArray();
	}

	/**
	 * Resolver for fetching all books.
	 *
	 * @return array<array<string,int|string|null>> An array of book in associative array format
	 */
	public function resolveAllBooks(): array
	{
		// Fetch all books from the repository
		$books = $this->bookRepository->findAll();

		return array_map(fn($book) => $book->toArray(), $books);
	}

	/**
	 * Resolver for adding a new book.
	 *
	 * @param mixed $root The root object (unused)
	 * @param array{
	 *   id: int,
	 *   title: string,
	 *   author: string,
	 *   publicationYear: int,
	 *   genre: string,
	 *  description?: string
	 * } $args The arguments for adding a new book
	 * @return array<string, int|string|null> The newly created Book entity
	 */
	public function resolveAddBook(mixed $root, array $args): array
	{
		$book = new Book();
		$book->setTitle($args['title']);
		$book->setAuthor($args['author']);
		$book->setPublicationYear($args['publicationYear']);
		$book->setGenre($args['genre']);
		$book->setDescription($args['description'] ?? null);

		// Persist the new book to the database
		$this->entityManager->persist($book);
		$this->entityManager->flush();
				
		return [
			'id' => $book->getId(),
			'title' => $book->getTitle(),
			'author' => $book->getAuthor(),
			'publicationYear' => $book->getPublicationYear(),
			'genre' => $book->getGenre(),
			'description' => $book->getDescription(),
		];
	}

	/**
	 * Resolver for updating an existing book.
	 *
	 * @param mixed $root The root object (unused)
	 * @param array{
	 *   id: int,
	 *   title?: string,
	 *   author?: string,
	 *   publicationYear?: int,
	 *   genre?: string,
	 *  description?: string
	 * } $args The arguments for adding a new book
	 * @return array<string, int|string|null>|null The updated Book entity, or null if not found
	 */
	public function resolveUpdateBook(mixed $root, array $args): ?array
	{
		// Find the book by ID
		$book = $this->bookRepository->find($args['id']);

		if (!$book) {
			return null; // Return null if the book does not exist
		}

		// Update only the provided fields
		if (isset($args['title'])) {
			$book->setTitle($args['title']);
		}
		if (isset($args['author'])) {
			$book->setAuthor($args['author']);
		}
		if (isset($args['publicationYear'])) {
			$book->setPublicationYear($args['publicationYear']);
		}
		if (isset($args['genre'])) {
			$book->setGenre($args['genre']);
		}
		if (isset($args['description'])) {
			$book->setDescription($args['description']);
		}

		// Save changes to the database
		$this->entityManager->flush();

		return $book->toArray();
	}

	/**
	 * Resolver for deleting a book.
	 *
	 * @param mixed $root The root object (unused)
	 * @param array<string,int> $args The arguments for deleting a book (id)
	 * @return bool True if deletion was successful, false if the book was not found
	 */
	public function resolveDeleteBook(mixed $root, array $args): bool
	{
		// Find the book by ID
		$book = $this->bookRepository->find($args['id']);

		if (!$book) {
			return false; // Return false if the book does not exist
		}

		// Remove the book from the database
		$this->entityManager->remove($book);
		$this->entityManager->flush();

		return true; // Return true if deletion was successful
	}
}
