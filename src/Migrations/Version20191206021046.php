<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206021046 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO category (id, name) VALUES (1, "Administrative")');
        $this->addSql('INSERT INTO category (id, name) VALUES (2, "Accommodation")');
        $this->addSql('INSERT INTO category (id, name) VALUES (3, "Student Life")');
        $this->addSql('INSERT INTO category (id, name) VALUES (4, "School")');
        $this->addSql('INSERT INTO category (id, name) VALUES (5, "Budget")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
