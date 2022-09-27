<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812091558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_taille ADD boisson_taille_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E075B6EEA7 FOREIGN KEY (boisson_taille_id) REFERENCES boissontaille (id)');
        $this->addSql('CREATE INDEX IDX_A517D3E075B6EEA7 ON menu_taille (boisson_taille_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_taille DROP FOREIGN KEY FK_A517D3E075B6EEA7');
        $this->addSql('DROP INDEX IDX_A517D3E075B6EEA7 ON menu_taille');
        $this->addSql('ALTER TABLE menu_taille DROP boisson_taille_id');
    }
}
