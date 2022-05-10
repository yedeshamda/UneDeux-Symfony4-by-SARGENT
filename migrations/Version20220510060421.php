<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510060421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison CHANGE etat etat enum(\'En cours\', \'Livré\')');
        $this->addSql('ALTER TABLE reclamation CHANGE iduser idUser INT NOT NULL, CHANGE sujetrec SujetRec VARCHAR(255) NOT NULL, CHANGE libelleproduit libelleProduit VARCHAR(100) DEFAULT NULL, CHANGE descriptionrec DescriptionRec VARCHAR(255) NOT NULL, CHANGE statusrec StatusRec VARCHAR(255) NOT NULL, CHANGE daterec DateRec DATE NOT NULL, CHANGE reponse Reponse VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison CHANGE etat etat VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE idUser iduser INT DEFAULT NULL, CHANGE SujetRec sujetrec VARCHAR(255) DEFAULT NULL, CHANGE libelleProduit libelleproduit VARCHAR(255) DEFAULT NULL, CHANGE DescriptionRec descriptionrec VARCHAR(255) DEFAULT NULL, CHANGE StatusRec statusrec VARCHAR(255) DEFAULT NULL, CHANGE DateRec daterec DATE DEFAULT NULL, CHANGE Reponse reponse VARCHAR(255) DEFAULT NULL');
    }
}
