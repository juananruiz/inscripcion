<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181126140038 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE domicilio CHANGE via via VARCHAR(255) DEFAULT NULL, CHANGE numero numero VARCHAR(255) DEFAULT NULL, CHANGE codigo_postal codigo_postal INT DEFAULT NULL, CHANGE localidad localidad VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE domicilio CHANGE via via VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE numero numero VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE codigo_postal codigo_postal INT NOT NULL, CHANGE localidad localidad VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
