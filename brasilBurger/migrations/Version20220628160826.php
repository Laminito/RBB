<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220628160826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menu_complement DROP FOREIGN KEY FK_D909AAE640D9D0AA');
        $this->addSql('CREATE TABLE menu_frites (menu_id INT NOT NULL, frites_id INT NOT NULL, INDEX IDX_FB6A61F2CCD7E912 (menu_id), INDEX IDX_FB6A61F218C0D7E1 (frites_id), PRIMARY KEY(menu_id, frites_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_boisson (menu_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_34CD5F3CCD7E912 (menu_id), INDEX IDX_34CD5F3734B8089 (boisson_id), PRIMARY KEY(menu_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille_boisson (taille_id INT NOT NULL, boisson_id INT NOT NULL, INDEX IDX_59FAC268FF25611A (taille_id), INDEX IDX_59FAC268734B8089 (boisson_id), PRIMARY KEY(taille_id, boisson_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menu_frites ADD CONSTRAINT FK_FB6A61F2CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_frites ADD CONSTRAINT FK_FB6A61F218C0D7E1 FOREIGN KEY (frites_id) REFERENCES frites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_boisson ADD CONSTRAINT FK_34CD5F3734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268FF25611A FOREIGN KEY (taille_id) REFERENCES taille (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE taille_boisson ADD CONSTRAINT FK_59FAC268734B8089 FOREIGN KEY (boisson_id) REFERENCES boisson (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE complement');
        $this->addSql('DROP TABLE menu_complement');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE taille_boisson DROP FOREIGN KEY FK_59FAC268FF25611A');
        $this->addSql('CREATE TABLE complement (id INT NOT NULL, nature VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE menu_complement (menu_id INT NOT NULL, complement_id INT NOT NULL, INDEX IDX_D909AAE640D9D0AA (complement_id), INDEX IDX_D909AAE6CCD7E912 (menu_id), PRIMARY KEY(menu_id, complement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE complement ADD CONSTRAINT FK_F8A41E34BF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_complement ADD CONSTRAINT FK_D909AAE6CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_complement ADD CONSTRAINT FK_D909AAE640D9D0AA FOREIGN KEY (complement_id) REFERENCES complement (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE menu_frites');
        $this->addSql('DROP TABLE menu_boisson');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP TABLE taille_boisson');
    }
}
