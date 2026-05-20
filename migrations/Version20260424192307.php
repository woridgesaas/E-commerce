<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260424192307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company_profiles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, company_email VARCHAR(100) NOT NULL, phone VARCHAR(20) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE modules (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, service_key VARCHAR(50) NOT NULL, server_type VARCHAR(50) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE products ADD modules_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A60D6DC42 FOREIGN KEY (modules_id) REFERENCES modules (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A60D6DC42 ON products (modules_id)');
        $this->addSql('ALTER TABLE subscriptions_registry ADD product_id INT NOT NULL, ADD company_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscriptions_registry ADD CONSTRAINT FK_84B679884584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE subscriptions_registry ADD CONSTRAINT FK_84B67988979B1AD6 FOREIGN KEY (company_id) REFERENCES company_profiles (id)');
        $this->addSql('CREATE INDEX IDX_84B679884584665A ON subscriptions_registry (product_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_84B67988979B1AD6 ON subscriptions_registry (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE company_profiles');
        $this->addSql('DROP TABLE modules');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A60D6DC42');
        $this->addSql('DROP INDEX IDX_B3BA5A5A60D6DC42 ON products');
        $this->addSql('ALTER TABLE products DROP modules_id');
        $this->addSql('ALTER TABLE subscriptions_registry DROP FOREIGN KEY FK_84B679884584665A');
        $this->addSql('ALTER TABLE subscriptions_registry DROP FOREIGN KEY FK_84B67988979B1AD6');
        $this->addSql('DROP INDEX IDX_84B679884584665A ON subscriptions_registry');
        $this->addSql('DROP INDEX UNIQ_84B67988979B1AD6 ON subscriptions_registry');
        $this->addSql('ALTER TABLE subscriptions_registry DROP product_id, DROP company_id');
    }
}
