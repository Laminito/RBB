<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701143157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE boisson_menu');
        $this->addSql('ALTER TABLE boisson_taille DROP FOREIGN KEY FK_E7A2EE1734B8089');
        $this->addSql('DROP INDEX IDX_E7A2EE1734B8089 ON boisson_taille');
        $this->addSql('ALTER TABLE boisson_taille DROP boisson_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE boisson_menu (boisson_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_1391FF6CCCD7E912 (menu_id), INDEX IDX_1391FF6C734B8089 (boisson_id), PRIMARY KEY(boisson_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE boisson_menu ADD CONSTRAINT FK_1391FF6CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_menu ADD CONSTRAINT FK_1391FF6C734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boisson_taille ADD boisson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson_taille ADD CONSTRAINT FK_E7A2EE1734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('CREATE INDEX IDX_E7A2EE1734B8089 ON boisson_taille (boisson_id)');
    }
}
