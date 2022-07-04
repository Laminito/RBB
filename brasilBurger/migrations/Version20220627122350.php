<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220627122350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_complement (menu_id INT NOT NULL, complement_id INT NOT NULL, INDEX IDX_D909AAE6CCD7E912 (menu_id), INDEX IDX_D909AAE640D9D0AA (complement_id), PRIMARY KEY(menu_id, complement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_burger (menu_id INT NOT NULL, burger_id INT NOT NULL, INDEX IDX_3CA402D5CCD7E912 (menu_id), INDEX IDX_3CA402D517CE5090 (burger_id), PRIMARY KEY(menu_id, burger_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_complement ADD CONSTRAINT FK_D909AAE6CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_complement ADD CONSTRAINT FK_D909AAE640D9D0AA FOREIGN KEY (complement_id) REFERENCES complement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D5CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_burger ADD CONSTRAINT FK_3CA402D517CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0D6BFA3AB7');
        $this->addSql('DROP INDEX IDX_EFE35A0D6BFA3AB7 ON burger');
        $this->addSql('ALTER TABLE burger DROP grstionnaire_id');
        $this->addSql('ALTER TABLE menu CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93BF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE menu_complement');
        $this->addSql('DROP TABLE menu_burger');
        $this->addSql('ALTER TABLE burger ADD grstionnaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D6BFA3AB7 FOREIGN KEY (grstionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0D6BFA3AB7 ON burger (grstionnaire_id)');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93BF396750');
        $this->addSql('ALTER TABLE menu CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
