<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260425010012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_modules (product_doctrine_id INT NOT NULL, module_doctrine_id INT NOT NULL, INDEX IDX_FF6E5867AD4BFA10 (product_doctrine_id), INDEX IDX_FF6E58678F4F6EDD (module_doctrine_id), PRIMARY KEY (product_doctrine_id, module_doctrine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product_modules ADD CONSTRAINT FK_FF6E5867AD4BFA10 FOREIGN KEY (product_doctrine_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_modules ADD CONSTRAINT FK_FF6E58678F4F6EDD FOREIGN KEY (module_doctrine_id) REFERENCES modules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY `FK_B3BA5A5A60D6DC42`');
        $this->addSql('DROP INDEX IDX_B3BA5A5A60D6DC42 ON products');
        $this->addSql('ALTER TABLE products DROP modules_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_modules DROP FOREIGN KEY FK_FF6E5867AD4BFA10');
        $this->addSql('ALTER TABLE product_modules DROP FOREIGN KEY FK_FF6E58678F4F6EDD');
        $this->addSql('DROP TABLE product_modules');
        $this->addSql('ALTER TABLE products ADD modules_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT `FK_B3BA5A5A60D6DC42` FOREIGN KEY (modules_id) REFERENCES modules (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A60D6DC42 ON products (modules_id)');
    }
}
