<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623170114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livreur ADD gestionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6D6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('CREATE INDEX IDX_EB7A4E6D6885AC1B ON livreur (gestionnaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6D6885AC1B');
        $this->addSql('DROP INDEX IDX_EB7A4E6D6885AC1B ON livreur');
        $this->addSql('ALTER TABLE livreur DROP gestionnaire_id');
    }
}
