<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260508171800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_profiles ADD ceo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE company_profiles ADD CONSTRAINT FK_93A7905D9435DF1D FOREIGN KEY (ceo_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93A7905D9435DF1D ON company_profiles (ceo_id)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY `FK_1483A5E97174FB2E`');
        $this->addSql('DROP INDEX UNIQ_1483A5E97174FB2E ON users');
        $this->addSql('ALTER TABLE users DROP company_profile_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company_profiles DROP FOREIGN KEY FK_93A7905D9435DF1D');
        $this->addSql('DROP INDEX UNIQ_93A7905D9435DF1D ON company_profiles');
        $this->addSql('ALTER TABLE company_profiles DROP ceo_id');
        $this->addSql('ALTER TABLE users ADD company_profile_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT `FK_1483A5E97174FB2E` FOREIGN KEY (company_profile_id) REFERENCES company_profiles (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E97174FB2E ON users (company_profile_id)');
    }
}
