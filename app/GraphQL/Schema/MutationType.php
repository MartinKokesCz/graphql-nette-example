<?php

namespace App\GraphQL\Schema;

use App\GraphQL\Resolvers\BookResolver;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType extends ObjectType
{
	public function __construct(BookResolver $bookResolver, BookType $bookType)
	{
		$config = [
			'name' => 'Mutation',
			'fields' => [
				'addBook' => [
					'type' => $bookType,
					'args' => [
						'title' => Type::nonNull(Type::string()),
						'author' => Type::nonNull(Type::string()),
						'publicationYear' => Type::nonNull(Type::int()),
						'genre' => Type::string(),
						'description' => Type::string(),
					],
					'resolve' => [$bookResolver, 'resolveAddBook']
				],
				'updateBook' => [
					'type' => $bookType,
					'args' => [
						'id' => Type::nonNull(Type::int()),
						'title' => Type::string(),
						'author' => Type::string(),
						'publicationYear' => Type::int(),
						'genre' => Type::string(),
						'description' => Type::string(),
					],
					'resolve' => [$bookResolver, 'resolveUpdateBook']
				],
				'deleteBook' => [
					'type' => Type::boolean(),
					'args' => [
						'id' => Type::nonNull(Type::int())
					],
					'resolve' => [$bookResolver, 'resolveDeleteBook']
				],
			]
		];
		parent::__construct($config);
	}
}
