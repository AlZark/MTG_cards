<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120155442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE deck_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE deck_cards_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE deck (id INT NOT NULL, user_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, upvotes INT NOT NULL, downvotes INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4FAC36379D86650F ON deck (user_id_id)');
        $this->addSql('COMMENT ON COLUMN deck.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE deck_cards (id INT NOT NULL, deck_id_id INT DEFAULT NULL, card_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C59FA212BE1964B8 ON deck_cards (deck_id_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, fullname VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE deck ADD CONSTRAINT FK_4FAC36379D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deck_cards ADD CONSTRAINT FK_C59FA212BE1964B8 FOREIGN KEY (deck_id_id) REFERENCES deck (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE deck_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE deck_cards_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE deck DROP CONSTRAINT FK_4FAC36379D86650F');
        $this->addSql('ALTER TABLE deck_cards DROP CONSTRAINT FK_C59FA212BE1964B8');
        $this->addSql('DROP TABLE deck');
        $this->addSql('DROP TABLE deck_cards');
        $this->addSql('DROP TABLE "user"');
    }
}
