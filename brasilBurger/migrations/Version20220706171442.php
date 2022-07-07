<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706171442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantite_boisson ADD boisson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quantite_boisson ADD CONSTRAINT FK_32D7B02D734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('CREATE INDEX IDX_32D7B02D734B8089 ON quantite_boisson (boisson_id)');
        $this->addSql('ALTER TABLE quantite_burger ADD burger_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quantite_burger ADD CONSTRAINT FK_C94F337B17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('CREATE INDEX IDX_C94F337B17CE5090 ON quantite_burger (burger_id)');
        $this->addSql('ALTER TABLE quantite_frite ADD frites_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quantite_frite ADD CONSTRAINT FK_55B21E5D18C0D7E1 FOREIGN KEY (frites_id) REFERENCES frites (id)');
        $this->addSql('CREATE INDEX IDX_55B21E5D18C0D7E1 ON quantite_frite (frites_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quantite_boisson DROP FOREIGN KEY FK_32D7B02D734B8089');
        $this->addSql('DROP INDEX IDX_32D7B02D734B8089 ON quantite_boisson');
        $this->addSql('ALTER TABLE quantite_boisson DROP boisson_id');
        $this->addSql('ALTER TABLE quantite_burger DROP FOREIGN KEY FK_C94F337B17CE5090');
        $this->addSql('DROP INDEX IDX_C94F337B17CE5090 ON quantite_burger');
        $this->addSql('ALTER TABLE quantite_burger DROP burger_id');
        $this->addSql('ALTER TABLE quantite_frite DROP FOREIGN KEY FK_55B21E5D18C0D7E1');
        $this->addSql('DROP INDEX IDX_55B21E5D18C0D7E1 ON quantite_frite');
        $this->addSql('ALTER TABLE quantite_frite DROP frites_id');
    }
}
