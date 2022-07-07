<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220705205906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD lignes_de_commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D8BE03916 FOREIGN KEY (lignes_de_commandes_id) REFERENCES ligne_de_commande (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D8BE03916 ON commande (lignes_de_commandes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D8BE03916');
        $this->addSql('DROP INDEX IDX_6EEAA67D8BE03916 ON commande');
        $this->addSql('ALTER TABLE commande DROP lignes_de_commandes_id');
    }
}
