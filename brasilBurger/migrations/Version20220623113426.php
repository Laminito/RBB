<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623113426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_C7440455E7927C74 ON client');
        $this->addSql('ALTER TABLE client DROP prenom, DROP nom, DROP etat, DROP email, DROP roles, DROP password, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_F4461B20E7927C74 ON gestionnaire');
        $this->addSql('ALTER TABLE gestionnaire DROP prenom, DROP nom, DROP etat, DROP email, DROP roles, DROP password, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE gestionnaire ADD CONSTRAINT FK_F4461B20BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_EB7A4E6DE7927C74 ON livreur');
        $this->addSql('ALTER TABLE livreur DROP prenom, DROP nom, DROP etat, DROP email, DROP roles, DROP password, CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE livreur ADD CONSTRAINT FK_EB7A4E6DBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE client ADD prenom VARCHAR(255) DEFAULT NULL, ADD nom VARCHAR(255) DEFAULT NULL, ADD etat TINYINT(1) DEFAULT NULL, ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455E7927C74 ON client (email)');
        $this->addSql('ALTER TABLE gestionnaire DROP FOREIGN KEY FK_F4461B20BF396750');
        $this->addSql('ALTER TABLE gestionnaire ADD prenom VARCHAR(255) DEFAULT NULL, ADD nom VARCHAR(255) DEFAULT NULL, ADD etat TINYINT(1) DEFAULT NULL, ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F4461B20E7927C74 ON gestionnaire (email)');
        $this->addSql('ALTER TABLE livreur DROP FOREIGN KEY FK_EB7A4E6DBF396750');
        $this->addSql('ALTER TABLE livreur ADD prenom VARCHAR(255) DEFAULT NULL, ADD nom VARCHAR(255) DEFAULT NULL, ADD etat TINYINT(1) DEFAULT NULL, ADD email VARCHAR(180) NOT NULL, ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB7A4E6DE7927C74 ON livreur (email)');
        $this->addSql('ALTER TABLE user DROP role');
    }
}
