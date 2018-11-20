<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181120061345 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sala (id INT AUTO_INCREMENT NOT NULL, provincia_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, localidad VARCHAR(255) NOT NULL, mapa_url VARCHAR(255) NOT NULL, INDEX IDX_E226041C4E7121AF (provincia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sala ADD CONSTRAINT FK_E226041C4E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
        $this->addSql('ALTER TABLE curso ADD sala_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE curso ADD CONSTRAINT FK_CA3B40ECC51CDF3F FOREIGN KEY (sala_id) REFERENCES sala (id)');
        $this->addSql('CREATE INDEX IDX_CA3B40ECC51CDF3F ON curso (sala_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE curso DROP FOREIGN KEY FK_CA3B40ECC51CDF3F');
        $this->addSql('DROP TABLE sala');
        $this->addSql('DROP INDEX IDX_CA3B40ECC51CDF3F ON curso');
        $this->addSql('ALTER TABLE curso DROP sala_id');
    }
}
