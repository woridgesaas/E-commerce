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
        // On garde uniquement les lignes qui concernent des éléments existants
        $this->addSql('ALTER TABLE company_profiles ADD ceo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE company_profiles ADD CONSTRAINT FK_93A7905D9435DF1D FOREIGN KEY (ceo_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93A7905D9435DF1D ON company_profiles (ceo_id)');
    }

    public function down(Schema $schema): void
    {

        $this->addSql('ALTER TABLE company_profiles DROP FOREIGN KEY FK_93A7905D9435DF1D');
        $this->addSql('DROP INDEX UNIQ_93A7905D9435DF1D ON company_profiles');
        $this->addSql('ALTER TABLE company_profiles DROP ceo_id');
    }
}
