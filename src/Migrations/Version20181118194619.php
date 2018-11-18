<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181118194619 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE provincia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sesion (id INT AUTO_INCREMENT NOT NULL, curso_id INT DEFAULT NULL, fecha_inicio DATETIME DEFAULT NULL, fecha_fin DATETIME DEFAULT NULL, INDEX IDX_1B45E21B87CB4A1F (curso_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curso (id INT AUTO_INCREMENT NOT NULL, descripcion LONGTEXT DEFAULT NULL, horas INT NOT NULL, nombre VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domicilio (id INT AUTO_INCREMENT NOT NULL, provincia_id INT DEFAULT NULL, via VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, codigo_postal INT NOT NULL, localidad VARCHAR(255) NOT NULL, INDEX IDX_9B942ED14E7121AF (provincia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE persona (id INT AUTO_INCREMENT NOT NULL, domicilio_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, clave VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_51E5B69B166FC4DD (domicilio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perfil (id INT AUTO_INCREMENT NOT NULL, persona_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_96657647F5F88DB9 (persona_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscripcion (id INT AUTO_INCREMENT NOT NULL, curso_id INT DEFAULT NULL, persona_id INT DEFAULT NULL, fecha_alta DATETIME DEFAULT NULL, fecha_baja DATETIME DEFAULT NULL, INDEX IDX_935E99F087CB4A1F (curso_id), INDEX IDX_935E99F0F5F88DB9 (persona_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, clase_css VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sesion ADD CONSTRAINT FK_1B45E21B87CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');
        $this->addSql('ALTER TABLE domicilio ADD CONSTRAINT FK_9B942ED14E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
        $this->addSql('ALTER TABLE persona ADD CONSTRAINT FK_51E5B69B166FC4DD FOREIGN KEY (domicilio_id) REFERENCES domicilio (id)');
        $this->addSql('ALTER TABLE perfil ADD CONSTRAINT FK_96657647F5F88DB9 FOREIGN KEY (persona_id) REFERENCES persona (id)');
        $this->addSql('ALTER TABLE inscripcion ADD CONSTRAINT FK_935E99F087CB4A1F FOREIGN KEY (curso_id) REFERENCES curso (id)');
        $this->addSql('ALTER TABLE inscripcion ADD CONSTRAINT FK_935E99F0F5F88DB9 FOREIGN KEY (persona_id) REFERENCES persona (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE domicilio DROP FOREIGN KEY FK_9B942ED14E7121AF');
        $this->addSql('ALTER TABLE sesion DROP FOREIGN KEY FK_1B45E21B87CB4A1F');
        $this->addSql('ALTER TABLE inscripcion DROP FOREIGN KEY FK_935E99F087CB4A1F');
        $this->addSql('ALTER TABLE persona DROP FOREIGN KEY FK_51E5B69B166FC4DD');
        $this->addSql('ALTER TABLE perfil DROP FOREIGN KEY FK_96657647F5F88DB9');
        $this->addSql('ALTER TABLE inscripcion DROP FOREIGN KEY FK_935E99F0F5F88DB9');
        $this->addSql('DROP TABLE provincia');
        $this->addSql('DROP TABLE sesion');
        $this->addSql('DROP TABLE curso');
        $this->addSql('DROP TABLE domicilio');
        $this->addSql('DROP TABLE persona');
        $this->addSql('DROP TABLE perfil');
        $this->addSql('DROP TABLE inscripcion');
        $this->addSql('DROP TABLE estado');
    }
}
