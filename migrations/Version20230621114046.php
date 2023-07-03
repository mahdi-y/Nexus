<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621114046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY fk_id_u2');
        $this->addSql('DROP INDEX fk_id_u2 ON question');
        $this->addSql('ALTER TABLE question ADD Titre_Q TEXT NOT NULL, DROP Id_U, CHANGE Vote_Q Vote_Q INT NOT NULL, CHANGE Signale_Q Signale_Q INT NOT NULL');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_q');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_u');
        $this->addSql('ALTER TABLE reponse CHANGE Vote_R Vote_R INT NOT NULL, CHANGE Etat_R Etat_R INT NOT NULL, CHANGE Signale_R Signale_R INT NOT NULL, CHANGE Id_Q Id_Q INT DEFAULT NULL, CHANGE Id_U Id_U INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A9C98BAE FOREIGN KEY (Id_Q) REFERENCES question (Id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7AEA44FB7 FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U)');
        $this->addSql('ALTER TABLE utilisateur CHANGE Role_U Role_U INT NOT NULL, CHANGE Verifie_U Verifie_U INT NOT NULL, CHANGE Actif_U Actif_U INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE question ADD Id_U INT NOT NULL, DROP Titre_Q, CHANGE Vote_Q Vote_Q INT DEFAULT 0 NOT NULL, CHANGE Signale_Q Signale_Q INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk_id_u2 FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX fk_id_u2 ON question (Id_U)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A9C98BAE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7AEA44FB7');
        $this->addSql('ALTER TABLE reponse CHANGE Vote_R Vote_R INT DEFAULT 0 NOT NULL, CHANGE Etat_R Etat_R INT DEFAULT 0 NOT NULL, CHANGE Signale_R Signale_R INT DEFAULT 0 NOT NULL, CHANGE Id_Q Id_Q INT NOT NULL, CHANGE Id_U Id_U INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_q FOREIGN KEY (Id_Q) REFERENCES question (Id_Q) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_u FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur CHANGE Role_U Role_U INT DEFAULT 0 NOT NULL, CHANGE Verifie_U Verifie_U INT DEFAULT 0 NOT NULL, CHANGE Actif_U Actif_U INT DEFAULT 0 NOT NULL');
    }
}
