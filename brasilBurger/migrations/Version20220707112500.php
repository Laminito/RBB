<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707112500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_boissontaille (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, boisson_taille_id INT DEFAULT NULL, qtboissontailles INT DEFAULT NULL, INDEX IDX_77C7497ACCD7E912 (menu_id), INDEX IDX_77C7497A75B6EEA7 (boisson_taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_boissontaille ADD CONSTRAINT FK_77C7497ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_boissontaille ADD CONSTRAINT FK_77C7497A75B6EEA7 FOREIGN KEY (boisson_taille_id) REFERENCES boisson_taille (id)');
        $this->addSql('DROP TABLE menu_boisson');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_boisson (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, boisson_id INT DEFAULT NULL, qtboissons INT DEFAULT NULL, INDEX IDX_34CD5F3CCD7E912 (menu_id), INDEX IDX_34CD5F3734B8089 (boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('DROP TABLE menu_boissontaille');
    }
}
