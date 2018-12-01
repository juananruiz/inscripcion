<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181201173209 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscripcion ADD estado_id INT NOT NULL DEFAULT 1');
        $this->addSql('ALTER TABLE inscripcion ADD CONSTRAINT FK_935E99F09F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('CREATE INDEX IDX_935E99F09F5A440B ON inscripcion (estado_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inscripcion DROP FOREIGN KEY FK_935E99F09F5A440B');
        $this->addSql('DROP INDEX IDX_935E99F09F5A440B ON inscripcion');
        $this->addSql('ALTER TABLE inscripcion DROP estado_id');
    }
}
