<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707092824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_burger (id INT AUTO_INCREMENT NOT NULL, qtburgers INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_frites (id INT AUTO_INCREMENT NOT NULL, qtfrites INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3CCD7E912');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3734B8089');
        $this->addSql('DROP INDEX IDX_34CD5F3CCD7E912 ON menu_boisson');
        $this->addSql('DROP INDEX IDX_34CD5F3734B8089 ON menu_boisson');
        $this->addSql('ALTER TABLE menu_boisson ADD id INT AUTO_INCREMENT NOT NULL, ADD qtboissons INT DEFAULT NULL, DROP menu_id, DROP boisson_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE menu_burger');
        $this->addSql('DROP TABLE menu_frites');
        $this->addSql('ALTER TABLE menu_boisson MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE menu_boisson DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE menu_boisson ADD menu_id INT NOT NULL, ADD boisson_id INT NOT NULL, DROP id, DROP qtboissons');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_34CD5F3CCD7E912 ON menu_boisson (menu_id)');
        $this->addSql('CREATE INDEX IDX_34CD5F3734B8089 ON menu_boisson (boisson_id)');
        $this->addSql('ALTER TABLE menu_boisson ADD PRIMARY KEY (menu_id, boisson_id)');
    }
}
