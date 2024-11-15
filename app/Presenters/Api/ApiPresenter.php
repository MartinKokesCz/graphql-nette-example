<?php

namespace App\Presenters\Api;

use App\GraphQL\Resolvers\BookResolver;
use App\GraphQL\Schema\BookType;
use App\GraphQL\Schema\MutationType;
use App\GraphQL\Schema\QueryType;
use App\Model\Database\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use GraphQL\Error\DebugFlag;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use Nette\Application\UI\Presenter;

class ApiPresenter extends Presenter
{
	private EntityManagerInterface $entityManager;

	/**
	 * GraphQLPresenter constructor.
	 *
	 * @param EntityManagerInterface $entityManager The Doctrine entity manager
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
		parent::__construct();
		$this->entityManager = $entityManager;
	}

	/**
	 * Main action for handling GraphQL queries and mutations.
	 */
	public function actionDefault(string $query): void
	{
		// Set up resolvers and types
		$bookResolver = new BookResolver(
			$this->entityManager->getRepository(Book::class),
			$this->entityManager
		);

		$bookType = new BookType();

		$queryType = new QueryType($bookResolver, $bookType);
		$mutationType = new MutationType($bookResolver, $bookType);

		// Create the schema with Query and Mutation types
		$schema = new Schema([
			'query' => $queryType,
			'mutation' => $mutationType,
		]);

		try {
			// Execute the GraphQL query
			$result = GraphQL::executeQuery($schema, $query);
			$output = $result->toArray();
		} catch (\Exception $e) {
			// Handle errors and format the output
			$output = [
				'errors' => [
					['message' => $e->getMessage()]
				]
			];
		}

		// Return the result as JSON response
		$this->sendJson($output);
	}
}