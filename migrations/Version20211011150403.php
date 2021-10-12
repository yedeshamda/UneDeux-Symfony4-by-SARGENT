<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011150403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_fiche_tech (produit_id INT NOT NULL, fiche_tech_id INT NOT NULL, INDEX IDX_C5349E94F347EFB (produit_id), INDEX IDX_C5349E947C732026 (fiche_tech_id), PRIMARY KEY(produit_id, fiche_tech_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_images (produit_id INT NOT NULL, images_id INT NOT NULL, INDEX IDX_174D7550F347EFB (produit_id), INDEX IDX_174D7550D44F05E5 (images_id), PRIMARY KEY(produit_id, images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_fiche_tech ADD CONSTRAINT FK_C5349E94F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_fiche_tech ADD CONSTRAINT FK_C5349E947C732026 FOREIGN KEY (fiche_tech_id) REFERENCES fiche_tech (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_images ADD CONSTRAINT FK_174D7550F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_images ADD CONSTRAINT FK_174D7550D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD categorie_id INT DEFAULT NULL, ADD marque_id INT DEFAULT NULL, ADD devis_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2741DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27BCF5E72D ON produit (categorie_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC274827B9B2 ON produit (marque_id)');
        $this->addSql('CREATE INDEX IDX_29A5EC2741DEFADA ON produit (devis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit_fiche_tech');
        $this->addSql('DROP TABLE produit_images');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274827B9B2');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2741DEFADA');
        $this->addSql('DROP INDEX IDX_29A5EC27BCF5E72D ON produit');
        $this->addSql('DROP INDEX IDX_29A5EC274827B9B2 ON produit');
        $this->addSql('DROP INDEX IDX_29A5EC2741DEFADA ON produit');
        $this->addSql('ALTER TABLE produit ADD image VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP categorie_id, DROP marque_id, DROP devis_id');
    }
}
