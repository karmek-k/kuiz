<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223175801 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Add User table, modify Quiz so that it has an author';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('DROP INDEX IDX_B6F7494E853CD175');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, quiz_id, name FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quiz_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_B6F7494E853CD175 FOREIGN KEY (quiz_id) REFERENCES quiz (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO question (id, quiz_id, name) SELECT id, quiz_id, name FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
        $this->addSql('CREATE INDEX IDX_B6F7494E853CD175 ON question (quiz_id)');
        $this->addSql('DROP INDEX IDX_DD80652D1E27F6BF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question_answer AS SELECT id, question_id, is_correct, text FROM question_answer');
        $this->addSql('DROP TABLE question_answer');
        $this->addSql('CREATE TABLE question_answer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, is_correct BOOLEAN NOT NULL, text VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_DD80652D1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO question_answer (id, question_id, is_correct, text) SELECT id, question_id, is_correct, text FROM __temp__question_answer');
        $this->addSql('DROP TABLE __temp__question_answer');
        $this->addSql('CREATE INDEX IDX_DD80652D1E27F6BF ON question_answer (question_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__quiz AS SELECT id, name, description FROM quiz');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('CREATE TABLE quiz (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_A412FA92F675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO quiz (id, name, description) SELECT id, name, description FROM __temp__quiz');
        $this->addSql('DROP TABLE __temp__quiz');
        $this->addSql('CREATE INDEX IDX_A412FA92F675F31B ON quiz (author_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_B6F7494E853CD175');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, quiz_id, name FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, quiz_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO question (id, quiz_id, name) SELECT id, quiz_id, name FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
        $this->addSql('CREATE INDEX IDX_B6F7494E853CD175 ON question (quiz_id)');
        $this->addSql('DROP INDEX IDX_DD80652D1E27F6BF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question_answer AS SELECT id, question_id, is_correct, text FROM question_answer');
        $this->addSql('DROP TABLE question_answer');
        $this->addSql('CREATE TABLE question_answer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, is_correct BOOLEAN NOT NULL, text VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO question_answer (id, question_id, is_correct, text) SELECT id, question_id, is_correct, text FROM __temp__question_answer');
        $this->addSql('DROP TABLE __temp__question_answer');
        $this->addSql('CREATE INDEX IDX_DD80652D1E27F6BF ON question_answer (question_id)');
        $this->addSql('DROP INDEX IDX_A412FA92F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__quiz AS SELECT id, name, description FROM quiz');
        $this->addSql('DROP TABLE quiz');
        $this->addSql('CREATE TABLE quiz (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO quiz (id, name, description) SELECT id, name, description FROM __temp__quiz');
        $this->addSql('DROP TABLE __temp__quiz');
    }
}
