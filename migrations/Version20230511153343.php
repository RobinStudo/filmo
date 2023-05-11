<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230511153343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add crew table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE crew (movie_id INT NOT NULL, person_id INT NOT NULL, role VARCHAR(30) NOT NULL, INDEX IDX_894940B28F93B6FC (movie_id), INDEX IDX_894940B2217BBB47 (person_id), PRIMARY KEY(movie_id, person_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crew ADD CONSTRAINT FK_894940B28F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE crew ADD CONSTRAINT FK_894940B2217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE crew DROP FOREIGN KEY FK_894940B28F93B6FC');
        $this->addSql('ALTER TABLE crew DROP FOREIGN KEY FK_894940B2217BBB47');
        $this->addSql('DROP TABLE crew');
    }
}
