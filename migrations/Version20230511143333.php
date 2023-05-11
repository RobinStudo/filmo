<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230511143333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add cast relation';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE cast (movie_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_12B8B9F68F93B6FC (movie_id), INDEX IDX_12B8B9F6217BBB47 (person_id), PRIMARY KEY(movie_id, person_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cast ADD CONSTRAINT FK_12B8B9F68F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cast ADD CONSTRAINT FK_12B8B9F6217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE cast DROP FOREIGN KEY FK_12B8B9F68F93B6FC');
        $this->addSql('ALTER TABLE cast DROP FOREIGN KEY FK_12B8B9F6217BBB47');
        $this->addSql('DROP TABLE cast');
    }
}
