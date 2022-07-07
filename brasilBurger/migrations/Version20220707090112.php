<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707090112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE quantite_boisson');
        $this->addSql('DROP TABLE quantite_burger');
        $this->addSql('DROP TABLE quantite_frite');
        $this->addSql('ALTER TABLE boisson ADD menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('CREATE INDEX IDX_8B97C84DCCD7E912 ON boisson (menu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quantite_boisson (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, boisson_id INT DEFAULT NULL, qt_boisson INT DEFAULT NULL, INDEX IDX_32D7B02DCCD7E912 (menu_id), INDEX IDX_32D7B02D734B8089 (boisson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quantite_burger (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, burger_id INT DEFAULT NULL, qtburger INT DEFAULT NULL, INDEX IDX_C94F337BCCD7E912 (menu_id), INDEX IDX_C94F337B17CE5090 (burger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quantite_frite (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, frites_id INT DEFAULT NULL, qt_frite INT DEFAULT NULL, INDEX IDX_55B21E5DCCD7E912 (menu_id), INDEX IDX_55B21E5D18C0D7E1 (frites_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE quantite_boisson ADD CONSTRAINT FK_32D7B02DCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE quantite_boisson ADD CONSTRAINT FK_32D7B02D734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('ALTER TABLE quantite_burger ADD CONSTRAINT FK_C94F337BCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE quantite_burger ADD CONSTRAINT FK_C94F337B17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('ALTER TABLE quantite_frite ADD CONSTRAINT FK_55B21E5DCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE quantite_frite ADD CONSTRAINT FK_55B21E5D18C0D7E1 FOREIGN KEY (frites_id) REFERENCES frites (id)');
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DCCD7E912');
        $this->addSql('DROP INDEX IDX_8B97C84DCCD7E912 ON boisson');
        $this->addSql('ALTER TABLE boisson DROP menu_id');
    }
}
