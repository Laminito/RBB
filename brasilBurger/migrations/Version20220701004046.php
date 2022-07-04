<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701004046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE complement (id INT NOT NULL, nature VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE complement ADD CONSTRAINT FK_F8A41E34BF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD facture_id INT DEFAULT NULL, ADD clients_id INT DEFAULT NULL, ADD zones_id INT DEFAULT NULL, ADD livraisons_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DAB014612 FOREIGN KEY (clients_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA6EAEB7A FOREIGN KEY (zones_id) REFERENCES zone (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DACFB3D99 FOREIGN KEY (livraisons_id) REFERENCES livraison (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6EEAA67D7F2DEE08 ON commande (facture_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DAB014612 ON commande (clients_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA6EAEB7A ON commande (zones_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DACFB3D99 ON commande (livraisons_id)');
        $this->addSql('ALTER TABLE ligne_de_commande ADD product_id INT DEFAULT NULL, ADD facture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ligne_de_commande ADD CONSTRAINT FK_7982ACE64584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE ligne_de_commande ADD CONSTRAINT FK_7982ACE67F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('CREATE INDEX IDX_7982ACE64584665A ON ligne_de_commande (product_id)');
        $this->addSql('CREATE INDEX IDX_7982ACE67F2DEE08 ON ligne_de_commande (facture_id)');
        $this->addSql('ALTER TABLE quartier ADD zone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quartier ADD CONSTRAINT FK_FEE8962D9F2C3FAB FOREIGN KEY (zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_FEE8962D9F2C3FAB ON quartier (zone_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE complement');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7F2DEE08');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAB014612');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA6EAEB7A');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DACFB3D99');
        $this->addSql('DROP INDEX UNIQ_6EEAA67D7F2DEE08 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DAB014612 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DA6EAEB7A ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67DACFB3D99 ON commande');
        $this->addSql('ALTER TABLE commande DROP facture_id, DROP clients_id, DROP zones_id, DROP livraisons_id');
        $this->addSql('ALTER TABLE ligne_de_commande DROP FOREIGN KEY FK_7982ACE64584665A');
        $this->addSql('ALTER TABLE ligne_de_commande DROP FOREIGN KEY FK_7982ACE67F2DEE08');
        $this->addSql('DROP INDEX IDX_7982ACE64584665A ON ligne_de_commande');
        $this->addSql('DROP INDEX IDX_7982ACE67F2DEE08 ON ligne_de_commande');
        $this->addSql('ALTER TABLE ligne_de_commande DROP product_id, DROP facture_id');
        $this->addSql('ALTER TABLE quartier DROP FOREIGN KEY FK_FEE8962D9F2C3FAB');
        $this->addSql('DROP INDEX IDX_FEE8962D9F2C3FAB ON quartier');
        $this->addSql('ALTER TABLE quartier DROP zone_id');
    }
}
