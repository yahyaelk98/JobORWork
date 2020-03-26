<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200325234045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE candidato (id INT AUTO_INCREMENT NOT NULL, oferta_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, cognoms VARCHAR(255) NOT NULL, telefon INT NOT NULL, estudis VARCHAR(255) NOT NULL, INDEX IDX_2867675AFAFBF624 (oferta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, logo VARCHAR(255) NOT NULL, tipus VARCHAR(255) NOT NULL, correu VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oferta (id INT AUTO_INCREMENT NOT NULL, empresa_id INT DEFAULT NULL, descripcio VARCHAR(255) NOT NULL, data_pub DATE NOT NULL, titol VARCHAR(255) NOT NULL, INDEX IDX_7479C8F2521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidato ADD CONSTRAINT FK_2867675AFAFBF624 FOREIGN KEY (oferta_id) REFERENCES oferta (id)');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F2521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F2521E1991');
        $this->addSql('ALTER TABLE candidato DROP FOREIGN KEY FK_2867675AFAFBF624');
        $this->addSql('DROP TABLE candidato');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP TABLE oferta');
    }
}
