<?php

namespace App\GraphQL\Schema;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class BookType extends ObjectType
{
	public function __construct()
	{
		$config = [
			'name' => 'Book',
			'fields' => [
				'id' => Type::nonNull(Type::int()),
				'title' => Type::nonNull(Type::string()),
				'author' => Type::nonNull(Type::string()),
				'publicationYear' => Type::int(),
				'genre' => Type::string(),
				'description' => Type::string(),
			]
		];
		parent::__construct($config);
	}
}
