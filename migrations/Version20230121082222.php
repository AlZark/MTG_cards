<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230121082222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deck_cards ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE deck_cards ADD deck_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE deck_cards ADD CONSTRAINT FK_C59FA212111948DC FOREIGN KEY (deck_id) REFERENCES decks (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C59FA212111948DC ON deck_cards (deck_id)');
        $this->addSql('ALTER TABLE deck_cards ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE deck_cards DROP CONSTRAINT FK_C59FA212111948DC');
        $this->addSql('DROP INDEX UNIQ_C59FA212111948DC');
        $this->addSql('DROP INDEX "primary"');
        $this->addSql('ALTER TABLE deck_cards DROP id');
        $this->addSql('ALTER TABLE deck_cards DROP deck_id');
    }
}
