<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230511134048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add movie table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, summary LONGTEXT NOT NULL, duration INT NOT NULL, released_at DATE DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE movie');
    }
}
