<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241111140536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'This migration creates the book table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE `book` (`id` INT AUTO_INCREMENT NOT NULL, `title` VARCHAR(255) NOT NULL, `author` VARCHAR(255) NOT NULL, `publication_year` INT NOT NULL, `genre` VARCHAR(255) NOT NULL, `description` LONGTEXT DEFAULT NULL, PRIMARY KEY(`id`)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `book`');
    }
}
