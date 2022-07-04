<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704134326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boisson (id INT AUTO_INCREMENT NOT NULL, nomprod VARCHAR(255) DEFAULT NULL, imageprod LONGBLOB DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, etatprod TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boisson_taille (id INT AUTO_INCREMENT NOT NULL, boisson_id INT DEFAULT NULL, taille_id INT DEFAULT NULL, prix_unitaire_selon_la_taille_du_boisson DOUBLE PRECISION DEFAULT NULL, INDEX IDX_E7A2EE1734B8089 (boisson_id), INDEX IDX_E7A2EE1FF25611A (taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE burger (id INT AUTO_INCREMENT NOT NULL, nomprod VARCHAR(255) DEFAULT NULL, imageprod LONGBLOB DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, etatprod TINYINT(1) DEFAULT NULL, categorie_burger VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(100) DEFAULT NULL, nom VARCHAR(100) DEFAULT NULL, login VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, etat_user TINYINT(1) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, gestionnaire_id INT DEFAULT NULL, zone_id INT DEFAULT NULL, etat_commande_id INT DEFAULT NULL, livraison_id INT DEFAULT NULL, date_commande DATETIME DEFAULT NULL, montant_commande DOUBLE PRECISION DEFAULT NULL, etat_payement TINYINT(1) DEFAULT NULL, type_recuperation VARCHAR(255) DEFAULT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), INDEX IDX_6EEAA67D6885AC1B (gestionnaire_id), INDEX IDX_6EEAA67D9F2C3FAB (zone_id), INDEX IDX_6EEAA67DEF9E8683 (etat_commande_id), INDEX IDX_6EEAA67D8E54FB25 (livraison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_commande (id INT AUTO_INCREMENT NOT NULL, etat_commande TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, etat_facture TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_FE86641082EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gestionnaire (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(100) DEFAULT NULL, nom VARCHAR(100) DEFAULT NULL, login VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, etat_user TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_de_commande (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, facture_id INT DEFAULT NULL, quantite_produit INT DEFAULT NULL, INDEX IDX_7982ACE6F347EFB (produit_id), INDEX IDX_7982ACE67F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, livreur_id INT DEFAULT NULL, durer_livraison DATETIME DEFAULT NULL, INDEX IDX_A60C9F1FF8646701 (livreur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreur (id INT AUTO_INCREMENT NOT NULL, gestionnaire_id INT DEFAULT NULL, prenom VARCHAR(100) DEFAULT NULL, nom VARCHAR(100) DEFAULT NULL, login VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, etat_user TINYINT(1) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, matricule VARCHAR(255) DEFAULT NULL, INDEX IDX_EB7A4E6D6885AC1B (gestionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, nomprod VARCHAR(255) DEFAULT NULL, imageprod LONGBLOB DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, etatprod TINYINT(1) DEFAULT NULL, libelle_menu VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_boisson (menu_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_34CD5F3CCD7E912 (menu_id), INDEX IDX_34CD5F3734B8089 (boisson_id), PRIMARY KEY(menu_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_burger (menu_id INT NOT NULL, burger_id INT NOT NULL, INDEX IDX_3CA402D5CCD7E912 (menu_id), INDEX IDX_3CA402D517CE5090 (burger_id), PRIMARY KEY(menu_id, burger_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(100) DEFAULT NULL, nom VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portion_frite (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, nomprod VARCHAR(255) DEFAULT NULL, imageprod LONGBLOB DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, etatprod TINYINT(1) DEFAULT NULL, INDEX IDX_8F393CADCCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, gestionnaire_id INT DEFAULT NULL, nomprod VARCHAR(255) DEFAULT NULL, imageprod LONGBLOB DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, etatprod TINYINT(1) DEFAULT NULL, INDEX IDX_29A5EC276885AC1B (gestionnaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quartier (id INT AUTO_INCREMENT NOT NULL, zone_id INT DEFAULT NULL, libelle VARCHAR(255) DEFAULT NULL, INDEX IDX_FEE8962D9F2C3FAB (zone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(100) DEFAULT NULL, nom VARCHAR(100) DEFAULT NULL, login VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, etat_user TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, prix_livraison DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DEF9E8683 FOREIGN KEY (etat_commande_id) REFERENCES etat_commande (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641082EA2E54 FOREIGN KEY (commande_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE ligne_de_commande ADD CONSTRAINT FK_7982ACE6F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ligne_de_commande ADD CONSTRAINT FK_7982ACE67F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FF8646701 FOREIGN KEY (livreur_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D5CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE portion_frite ADD CONSTRAINT FK_8F393CADCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC276885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson_taille DROP FOREIGN KEY FK_E7A2EE1734B8089');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3734B8089');
        $this->addSql('ALTER TABLE menu_burger DROP FOREIGN KEY FK_3CA402D517CE5090');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DEF9E8683');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641082EA2E54');
        $this->addSql('ALTER TABLE ligne_de_commande DROP FOREIGN KEY FK_7982ACE67F2DEE08');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D6885AC1B');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6D6885AC1B');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC276885AC1B');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8E54FB25');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FF8646701');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3CCD7E912');
        $this->addSql('ALTER TABLE menu_burger DROP FOREIGN KEY FK_3CA402D5CCD7E912');
        $this->addSql('ALTER TABLE portion_frite DROP FOREIGN KEY FK_8F393CADCCD7E912');
        $this->addSql('ALTER TABLE ligne_de_commande DROP FOREIGN KEY FK_7982ACE6F347EFB');
        $this->addSql('ALTER TABLE boisson_taille DROP FOREIGN KEY FK_E7A2EE1FF25611A');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9F2C3FAB');
        $this->addSql('ALTER TABLE quartier DROP FOREIGN KEY FK_FEE8962D9F2C3FAB');
        $this->addSql('DROP TABLE boisson');
        $this->addSql('DROP TABLE boisson_taille');
        $this->addSql('DROP TABLE burger');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE etat_commande');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE gestionnaire');
        $this->addSql('DROP TABLE ligne_de_commande');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE menu_boisson');
        $this->addSql('DROP TABLE menu_burger');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE portion_frite');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE quartier');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE zone');
    }
}
