<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717144305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE guest (id INT NOT NULL, user_id_who_registered INT NOT NULL, name VARCHAR(100) NOT NULL, surname VARCHAR(100) NOT NULL, date_of_birth DATETIME NOT NULL, gender VARCHAR(1) NOT NULL, passport_number VARCHAR(20) NOT NULL, country VARCHAR(3) NOT NULL, registration_id INT UNSIGNED NOT NULL, INDEX IDX_ACB79A35D6643CD1 (user_id_who_registered), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE guest ADD CONSTRAINT FK_ACB79A35D6643CD1 FOREIGN KEY (user_id_who_registered) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guest DROP FOREIGN KEY FK_ACB79A35D6643CD1');
        $this->addSql('DROP TABLE guest');
        $this->addSql('DROP TABLE users');
    }
}
