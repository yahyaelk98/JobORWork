<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200310080845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidato ADD oferta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidato ADD CONSTRAINT FK_2867675AFAFBF624 FOREIGN KEY (oferta_id) REFERENCES oferta (id)');
        $this->addSql('CREATE INDEX IDX_2867675AFAFBF624 ON candidato (oferta_id)');
        $this->addSql('ALTER TABLE oferta ADD empresa_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oferta ADD CONSTRAINT FK_7479C8F2521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('CREATE INDEX IDX_7479C8F2521E1991 ON oferta (empresa_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidato DROP FOREIGN KEY FK_2867675AFAFBF624');
        $this->addSql('DROP INDEX IDX_2867675AFAFBF624 ON candidato');
        $this->addSql('ALTER TABLE candidato DROP oferta_id');
        $this->addSql('ALTER TABLE oferta DROP FOREIGN KEY FK_7479C8F2521E1991');
        $this->addSql('DROP INDEX IDX_7479C8F2521E1991 ON oferta');
        $this->addSql('ALTER TABLE oferta DROP empresa_id');
    }
}
