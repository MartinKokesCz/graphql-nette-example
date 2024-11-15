<?php

namespace App\Model\Database\Entity;

use App\Model\Database\Repository\BookRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: BookRepository::class)]
#[Table(name: 'book')]
class Book
{
	#[Id]
	#[GeneratedValue]
	#[Column(type: 'integer')]
	private int $id;

	#[Column(type: 'string', length: 255)]
	private string $title;

	#[Column(type: 'string', length: 255)]
	private string $author;

	#[Column(type: 'integer')]
	private int $publicationYear;

	#[Column(type: 'string', length: 100)]
	private string $genre;

	#[Column(type: 'text', nullable: true)]
	private ?string $description;

	public function getId(): int
	{
		return $this->id;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): self
	{
		$this->title = $title;
		return $this;
	}

	public function getAuthor(): string
	{
		return $this->author;
	}

	public function setAuthor(string $author): self
	{
		$this->author = $author;
		return $this;
	}

	public function getPublicationYear(): int
	{
		return $this->publicationYear;
	}

	public function setPublicationYear(int $publicationYear): self
	{
		$this->publicationYear = $publicationYear;
		return $this;
	}

	public function getGenre(): ?string
	{
		return $this->genre;
	}

	public function setGenre(string $genre): self
	{
		$this->genre = $genre;
		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setDescription(?string $description): self
	{
		$this->description = $description;
		return $this;
	}
	
	/**
	 * Convert the entity to an array.
	 *
	 * @return array<string,int|string|null> The entity as an array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->getId(),
			'title' => $this->getTitle(),
			'author' => $this->getAuthor(),
			'publicationYear' => $this->getPublicationYear(),
			'genre' => $this->getGenre(),
			'description' => $this->getDescription(),
		];
	}
}
