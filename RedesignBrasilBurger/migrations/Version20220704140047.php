<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704140047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP nomprod, DROP imageprod, DROP prix, DROP etatprod, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger DROP nomprod, DROP imageprod, DROP prix, DROP etatprod, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0DBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client DROP prenom, DROP nom, DROP login, DROP password, DROP etat_user, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gestionnaire DROP prenom, DROP nom, DROP login, DROP password, DROP etat_user, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE gestionnaire ADD CONSTRAINT FK_F4461B20BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livreur DROP prenom, DROP nom, DROP login, DROP password, DROP etat_user, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DBF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu DROP nomprod, DROP imageprod, DROP prix, DROP etatprod, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93BF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portion_frite DROP nomprod, DROP imageprod, DROP prix, DROP etatprod, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CADBF396750 FOREIGN KEY (id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user DROP prenom, DROP nom, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BF396750 FOREIGN KEY (id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DBF396750');
        $this->addSql('ALTER TABLE boisson ADD nomprod VARCHAR(255) DEFAULT NULL, ADD imageprod LONGBLOB DEFAULT NULL, ADD prix DOUBLE PRECISION DEFAULT NULL, ADD etatprod TINYINT(1) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0DBF396750');
        $this->addSql('ALTER TABLE burger ADD nomprod VARCHAR(255) DEFAULT NULL, ADD imageprod LONGBLOB DEFAULT NULL, ADD prix DOUBLE PRECISION DEFAULT NULL, ADD etatprod TINYINT(1) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE client ADD prenom VARCHAR(100) DEFAULT NULL, ADD nom VARCHAR(100) DEFAULT NULL, ADD login VARCHAR(255) DEFAULT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD etat_user TINYINT(1) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE gestionnaire DROP FOREIGN KEY FK_F4461B20BF396750');
        $this->addSql('ALTER TABLE gestionnaire ADD prenom VARCHAR(100) DEFAULT NULL, ADD nom VARCHAR(100) DEFAULT NULL, ADD login VARCHAR(255) DEFAULT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD etat_user TINYINT(1) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6DBF396750');
        $this->addSql('ALTER TABLE livreur ADD prenom VARCHAR(100) DEFAULT NULL, ADD nom VARCHAR(100) DEFAULT NULL, ADD login VARCHAR(255) DEFAULT NULL, ADD password VARCHAR(255) DEFAULT NULL, ADD etat_user TINYINT(1) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93BF396750');
        $this->addSql('ALTER TABLE menu ADD nomprod VARCHAR(255) DEFAULT NULL, ADD imageprod LONGBLOB DEFAULT NULL, ADD prix DOUBLE PRECISION DEFAULT NULL, ADD etatprod TINYINT(1) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE portion_frite DROP FOREIGN KEY FK_8F393CADBF396750');
        $this->addSql('ALTER TABLE portion_frite ADD nomprod VARCHAR(255) DEFAULT NULL, ADD imageprod LONGBLOB DEFAULT NULL, ADD prix DOUBLE PRECISION DEFAULT NULL, ADD etatprod TINYINT(1) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE produit DROP type');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BF396750');
        $this->addSql('ALTER TABLE user ADD prenom VARCHAR(100) DEFAULT NULL, ADD nom VARCHAR(100) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
