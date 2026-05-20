<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260508001718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activation_tokens (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, expire_at DATETIME NOT NULL, used TINYINT NOT NULL, subscription_id INT NOT NULL, UNIQUE INDEX UNIQ_C1DFC3591D775834 (value), INDEX IDX_C1DFC3599A1887DC (subscription_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE activation_tokens ADD CONSTRAINT FK_C1DFC3599A1887DC FOREIGN KEY (subscription_id) REFERENCES subscriptions_registry (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activation_tokens DROP FOREIGN KEY FK_C1DFC3599A1887DC');
        $this->addSql('DROP TABLE activation_tokens');
    }
}
