<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707115446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_taille (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, taille_id INT DEFAULT NULL, qttailles INT DEFAULT NULL, INDEX IDX_A517D3E0CCD7E912 (menu_id), INDEX IDX_A517D3E0FF25611A (taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_taille ADD CONSTRAINT FK_A517D3E0FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id)');
        $this->addSql('DROP TABLE menu_boissontaille');
        $this->addSql('ALTER TABLE taille ADD prixtaille DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_boissontaille (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, boisson_taille_id INT DEFAULT NULL, qtboissontailles INT DEFAULT NULL, INDEX IDX_77C7497ACCD7E912 (menu_id), INDEX IDX_77C7497A75B6EEA7 (boisson_taille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_boissontaille ADD CONSTRAINT FK_77C7497A75B6EEA7 FOREIGN KEY (boisson_taille_id) REFERENCES boisson_taille (id)');
        $this->addSql('ALTER TABLE menu_boissontaille ADD CONSTRAINT FK_77C7497ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('DROP TABLE menu_taille');
        $this->addSql('ALTER TABLE taille DROP prixtaille');
    }
}
