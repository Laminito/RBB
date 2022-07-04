<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623193723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP nom, DROP image, DROP prix, DROP type, DROP nature, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE boisson ADD CONSTRAINT FK_8B97C84DBF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE burger DROP nom, DROP image, DROP prix, DROP type, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0DBF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE complement DROP nom, DROP image, DROP prix, DROP type, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE complement ADD CONSTRAINT FK_F8A41E34BF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE frites DROP nom, DROP image, DROP prix, DROP type, DROP nature, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE frites ADD CONSTRAINT FK_282D392ABF396750 FOREIGN KEY (id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD gestionnaire_id INT DEFAULT NULL, CHANGE type type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD6885AC1B FOREIGN KEY (gestionnaire_id) REFERENCES gestionnaire (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD6885AC1B ON product (gestionnaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boisson DROP FOREIGN KEY FK_8B97C84DBF396750');
        $this->addSql('ALTER TABLE boisson ADD nom VARCHAR(255) DEFAULT NULL, ADD image LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', ADD prix DOUBLE PRECISION DEFAULT NULL, ADD type VARCHAR(255) DEFAULT NULL, ADD nature VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE burger DROP FOREIGN KEY FK_EFE35A0DBF396750');
        $this->addSql('ALTER TABLE burger ADD nom VARCHAR(255) DEFAULT NULL, ADD image LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', ADD prix DOUBLE PRECISION DEFAULT NULL, ADD type VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE complement DROP FOREIGN KEY FK_F8A41E34BF396750');
        $this->addSql('ALTER TABLE complement ADD nom VARCHAR(255) DEFAULT NULL, ADD image LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', ADD prix DOUBLE PRECISION DEFAULT NULL, ADD type VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE frites DROP FOREIGN KEY FK_282D392ABF396750');
        $this->addSql('ALTER TABLE frites ADD nom VARCHAR(255) DEFAULT NULL, ADD image LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', ADD prix DOUBLE PRECISION DEFAULT NULL, ADD type VARCHAR(255) DEFAULT NULL, ADD nature VARCHAR(255) DEFAULT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD6885AC1B');
        $this->addSql('DROP INDEX IDX_D34A04AD6885AC1B ON product');
        $this->addSql('ALTER TABLE product DROP gestionnaire_id, CHANGE type type VARCHAR(255) DEFAULT NULL');
    }
}
