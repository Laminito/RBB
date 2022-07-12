<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707093552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_boisson ADD menu_id INT DEFAULT NULL, ADD boisson_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id)');
        $this->addSql('CREATE INDEX IDX_34CD5F3CCD7E912 ON menu_boisson (menu_id)');
        $this->addSql('CREATE INDEX IDX_34CD5F3734B8089 ON menu_boisson (boisson_id)');
        $this->addSql('ALTER TABLE menu_burger ADD menu_id INT DEFAULT NULL, ADD burger_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D5CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id)');
        $this->addSql('CREATE INDEX IDX_3CA402D5CCD7E912 ON menu_burger (menu_id)');
        $this->addSql('CREATE INDEX IDX_3CA402D517CE5090 ON menu_burger (burger_id)');
        $this->addSql('ALTER TABLE menu_frites ADD menu_id INT DEFAULT NULL, ADD frites_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_frites ADD CONSTRAINT FK_FB6A61F2CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu_frites ADD CONSTRAINT FK_FB6A61F218C0D7E1 FOREIGN KEY (frites_id) REFERENCES frites (id)');
        $this->addSql('CREATE INDEX IDX_FB6A61F2CCD7E912 ON menu_frites (menu_id)');
        $this->addSql('CREATE INDEX IDX_FB6A61F218C0D7E1 ON menu_frites (frites_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3CCD7E912');
        $this->addSql('ALTER TABLE menu_boisson DROP FOREIGN KEY FK_34CD5F3734B8089');
        $this->addSql('DROP INDEX IDX_34CD5F3CCD7E912 ON menu_boisson');
        $this->addSql('DROP INDEX IDX_34CD5F3734B8089 ON menu_boisson');
        $this->addSql('ALTER TABLE menu_boisson DROP menu_id, DROP boisson_id');
        $this->addSql('ALTER TABLE menu_burger DROP FOREIGN KEY FK_3CA402D5CCD7E912');
        $this->addSql('ALTER TABLE menu_burger DROP FOREIGN KEY FK_3CA402D517CE5090');
        $this->addSql('DROP INDEX IDX_3CA402D5CCD7E912 ON menu_burger');
        $this->addSql('DROP INDEX IDX_3CA402D517CE5090 ON menu_burger');
        $this->addSql('ALTER TABLE menu_burger DROP menu_id, DROP burger_id');
        $this->addSql('ALTER TABLE menu_frites DROP FOREIGN KEY FK_FB6A61F2CCD7E912');
        $this->addSql('ALTER TABLE menu_frites DROP FOREIGN KEY FK_FB6A61F218C0D7E1');
        $this->addSql('DROP INDEX IDX_FB6A61F2CCD7E912 ON menu_frites');
        $this->addSql('DROP INDEX IDX_FB6A61F218C0D7E1 ON menu_frites');
        $this->addSql('ALTER TABLE menu_frites DROP menu_id, DROP frites_id');
    }
}
