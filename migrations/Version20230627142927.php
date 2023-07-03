<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627142927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        // Check if the 'user_id' column already exists in the 'question' table
        $sm = $schema->getTable('question');
        if (!$sm->hasColumn('user_id')) {
            $this->addSql('ALTER TABLE question ADD user_id INT DEFAULT NULL');
            $this->addSql('UPDATE question SET user_id = Id_U');
            $this->addSql('ALTER TABLE question CHANGE user_id user_id INT NOT NULL');
            $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (idU)');
            $this->addSql('CREATE INDEX IDX_B6F7494EA76ED395 ON question (user_id)');
        }
        
        // Rest of the migration statements for other tables
        
        // ...
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EA76ED395');
        $this->addSql('DROP INDEX IDX_B6F7494EA76ED395 ON question');
        
        // Rest of the migration statements for other tables
        
        // ...
    }
}
