<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211012090332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, datecreation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, baniere VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel INT NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel INT NOT NULL, email VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fiche_tech (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, datecreation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, datecreation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametre (id INT AUTO_INCREMENT NOT NULL, tel1 INT NOT NULL, tel2 INT NOT NULL, email VARCHAR(255) NOT NULL, fb VARCHAR(255) NOT NULL, youtube VARCHAR(255) NOT NULL, linkedin VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, instagram VARCHAR(255) NOT NULL, jourdebut VARCHAR(255) NOT NULL, jourfin VARCHAR(255) NOT NULL, heuredebut VARCHAR(255) NOT NULL, heurefin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, devis_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, datecreation DATE NOT NULL, slug VARCHAR(255) NOT NULL, descriptiontech VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), INDEX IDX_29A5EC274827B9B2 (marque_id), INDEX IDX_29A5EC2741DEFADA (devis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_fiche_tech (produit_id INT NOT NULL, fiche_tech_id INT NOT NULL, INDEX IDX_C5349E94F347EFB (produit_id), INDEX IDX_C5349E947C732026 (fiche_tech_id), PRIMARY KEY(produit_id, fiche_tech_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_images (produit_id INT NOT NULL, images_id INT NOT NULL, INDEX IDX_174D7550F347EFB (produit_id), INDEX IDX_174D7550D44F05E5 (images_id), PRIMARY KEY(produit_id, images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, datecreation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2741DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE produit_fiche_tech ADD CONSTRAINT FK_C5349E94F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_fiche_tech ADD CONSTRAINT FK_C5349E947C732026 FOREIGN KEY (fiche_tech_id) REFERENCES fiche_tech (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_images ADD CONSTRAINT FK_174D7550F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_images ADD CONSTRAINT FK_174D7550D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2741DEFADA');
        $this->addSql('ALTER TABLE produit_fiche_tech DROP FOREIGN KEY FK_C5349E947C732026');
        $this->addSql('ALTER TABLE produit_images DROP FOREIGN KEY FK_174D7550D44F05E5');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274827B9B2');
        $this->addSql('ALTER TABLE produit_fiche_tech DROP FOREIGN KEY FK_C5349E94F347EFB');
        $this->addSql('ALTER TABLE produit_images DROP FOREIGN KEY FK_174D7550F347EFB');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE fiche_tech');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE parametre');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_fiche_tech');
        $this->addSql('DROP TABLE produit_images');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
    }
}
