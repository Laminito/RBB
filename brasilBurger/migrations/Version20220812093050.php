<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812093050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_burger DROP FOREIGN KEY FK_3CA402D517CE5090');
        $this->addSql('DROP INDEX IDX_3CA402D517CE5090 ON menu_burger');
        $this->addSql('ALTER TABLE menu_burger DROP burger_id');
        $this->addSql('ALTER TABLE menu_frites DROP FOREIGN KEY FK_FB6A61F218C0D7E1');
        $this->addSql('DROP INDEX IDX_FB6A61F218C0D7E1 ON menu_frites');
        $this->addSql('ALTER TABLE menu_frites DROP frites_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_burger ADD burger_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('CREATE INDEX IDX_3CA402D517CE5090 ON menu_burger (burger_id)');
        $this->addSql('ALTER TABLE menu_frites ADD frites_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_frites ADD CONSTRAINT FK_FB6A61F218C0D7E1 FOREIGN KEY (frites_id) REFERENCES frites (id)');
        $this->addSql('CREATE INDEX IDX_FB6A61F218C0D7E1 ON menu_frites (frites_id)');
    }
}
