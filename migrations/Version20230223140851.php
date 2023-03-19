<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223140851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE booking_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, author_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23A0E66F675F31B ON article (author_id)');
        $this->addSql('CREATE TABLE booking (id INT NOT NULL, title VARCHAR(255) NOT NULL, start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ending TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description TEXT DEFAULT NULL, all_day BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, author_id INT DEFAULT NULL, article_id INT DEFAULT NULL, content VARCHAR(500) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_reported BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('CREATE INDEX IDX_9474526C7294869C ON comment (article_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON DEFAULT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, avatar_file_name VARCHAR(255) DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, is_verified BOOLEAN NOT NULL, name VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, pronouns VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE booking_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66F675F31B');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CF675F31B');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C7294869C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE "user"');
    }
}
