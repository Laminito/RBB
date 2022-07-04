<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701004247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD etatcommande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D48EDE239 FOREIGN KEY (etatcommande_id) REFERENCES etat_commande (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D48EDE239 ON commande (etatcommande_id)');
        $this->addSql('ALTER TABLE livraison ADD livreurs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F908EE9D4 FOREIGN KEY (livreurs_id) REFERENCES livreur (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F908EE9D4 ON livraison (livreurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D48EDE239');
        $this->addSql('DROP INDEX IDX_6EEAA67D48EDE239 ON commande');
        $this->addSql('ALTER TABLE commande DROP etatcommande_id');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F908EE9D4');
        $this->addSql('DROP INDEX IDX_A60C9F1F908EE9D4 ON livraison');
        $this->addSql('ALTER TABLE livraison DROP livreurs_id');
    }
}
