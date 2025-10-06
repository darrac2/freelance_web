<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250707062001 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE devis ADD offre_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8B27C52B4CC8505A ON devis (offre_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B4CC8505A
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_8B27C52B4CC8505A ON devis
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE devis DROP offre_id
        SQL);
    }
}
