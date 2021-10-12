<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011144959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parametre (id INT AUTO_INCREMENT NOT NULL, tel1 INT NOT NULL, tel2 INT NOT NULL, email VARCHAR(255) NOT NULL, fb VARCHAR(255) NOT NULL, youtube VARCHAR(255) NOT NULL, linkedin VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, instagram VARCHAR(255) NOT NULL, jourdebut VARCHAR(255) NOT NULL, jourfin VARCHAR(255) NOT NULL, heuredebut VARCHAR(255) NOT NULL, heurefin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE parametre');
    }
}
