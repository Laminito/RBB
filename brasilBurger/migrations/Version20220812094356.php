<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812094356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE frites ADD menu_frites_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE frites ADD CONSTRAINT FK_282D392A180B0D5 FOREIGN KEY (menu_frites_id) REFERENCES menu_frites (id)');
        $this->addSql('CREATE INDEX IDX_282D392A180B0D5 ON frites (menu_frites_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE frites DROP FOREIGN KEY FK_282D392A180B0D5');
        $this->addSql('DROP INDEX IDX_282D392A180B0D5 ON frites');
        $this->addSql('ALTER TABLE frites DROP menu_frites_id');
    }
}
