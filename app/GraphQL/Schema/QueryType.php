<?php

namespace App\GraphQL\Schema;

use App\GraphQL\Resolvers\BookResolver;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class QueryType extends ObjectType
{
	public function __construct(BookResolver $bookResolver, BookType $bookType)
	{
		$config = [
			'name' => 'Query',
			'description' => 'The root query for fetching books and other data.',
			'fields' => [
				'book' => [
					'type' => $bookType,
					'description' => 'Fetch a single book by its ID.',
					'args' => [
						'id' => [
							'type' => Type::nonNull(Type::int()),
							'description' => 'The ID of the book to fetch.'
						]
					],
					'resolve' => [$bookResolver, 'resolveBook']
				],
				'allBooks' => [
					'type' => Type::listOf($bookType),
					'description' => 'Fetch a list of all books in the library.',
					'resolve' => [$bookResolver, 'resolveAllBooks']
				]
			]
		];
		parent::__construct($config);
	}
}
