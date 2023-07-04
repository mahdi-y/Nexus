<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230704093422 extends AbstractMigration
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
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY fk_id_u2');
        $this->addSql('ALTER TABLE question DROP user_id, CHANGE Vote_Q Vote_Q INT NOT NULL, CHANGE Signale_Q Signale_Q INT NOT NULL, CHANGE Id_U id_u INT DEFAULT NULL, CHANGE Titre_Q Titre_Q TEXT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E35F8C041 FOREIGN KEY (id_u) REFERENCES utilisateur (id_u)');
        $this->addSql('DROP INDEX fk_id_u2 ON question');
        $this->addSql('CREATE INDEX IDX_B6F7494E35F8C041 ON question (id_u)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk_id_u2 FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_q');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_u');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_q');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_u');
        $this->addSql('ALTER TABLE reponse CHANGE Contenu_R contenu_r VARCHAR(150) NOT NULL, CHANGE Date_Ajout_R date_ajout_r DATETIME NOT NULL, CHANGE Vote_R vote_r INT NOT NULL, CHANGE Etat_R etat_r INT NOT NULL, CHANGE Signale_R signale_r INT NOT NULL, CHANGE Id_Q Id_Q INT DEFAULT NULL, CHANGE Id_U id_u INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A9C98BAE FOREIGN KEY (Id_Q) REFERENCES question (id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC735F8C041 FOREIGN KEY (id_u) REFERENCES utilisateur (id_u)');
        $this->addSql('DROP INDEX fk_id_q ON reponse');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7A9C98BAE ON reponse (Id_Q)');
        $this->addSql('DROP INDEX fk_id_u ON reponse');
        $this->addSql('CREATE INDEX IDX_5FB6DEC735F8C041 ON reponse (id_u)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_q FOREIGN KEY (Id_Q) REFERENCES question (Id_Q) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_u FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur CHANGE Role_U Role_U INT NOT NULL, CHANGE Verifie_U Verifie_U INT NOT NULL, CHANGE Actif_U Actif_U INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E35F8C041');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E35F8C041');
        $this->addSql('ALTER TABLE question ADD user_id INT NOT NULL, CHANGE id_u Id_U INT NOT NULL, CHANGE Titre_Q Titre_Q VARCHAR(255) NOT NULL, CHANGE Vote_Q Vote_Q INT DEFAULT 0 NOT NULL, CHANGE Signale_Q Signale_Q INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk_id_u2 FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_b6f7494e35f8c041 ON question');
        $this->addSql('CREATE INDEX fk_id_u2 ON question (Id_U)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E35F8C041 FOREIGN KEY (id_u) REFERENCES utilisateur (id_u)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A9C98BAE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC735F8C041');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A9C98BAE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC735F8C041');
        $this->addSql('ALTER TABLE reponse CHANGE id_u Id_U INT NOT NULL, CHANGE contenu_r Contenu_R TEXT NOT NULL, CHANGE date_ajout_r Date_Ajout_R DATE NOT NULL, CHANGE vote_r Vote_R INT DEFAULT 0 NOT NULL, CHANGE etat_r Etat_R INT DEFAULT 0 NOT NULL, CHANGE signale_r Signale_R INT DEFAULT 0 NOT NULL, CHANGE Id_Q Id_Q INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_q FOREIGN KEY (Id_Q) REFERENCES question (Id_Q) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_u FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_5fb6dec735f8c041 ON reponse');
        $this->addSql('CREATE INDEX fk_id_u ON reponse (Id_U)');
        $this->addSql('DROP INDEX idx_5fb6dec7a9c98bae ON reponse');
        $this->addSql('CREATE INDEX fk_id_q ON reponse (Id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A9C98BAE FOREIGN KEY (Id_Q) REFERENCES question (id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC735F8C041 FOREIGN KEY (id_u) REFERENCES utilisateur (id_u)');
        $this->addSql('ALTER TABLE utilisateur CHANGE Role_U Role_U INT DEFAULT 0 NOT NULL, CHANGE Verifie_U Verifie_U INT DEFAULT 0 NOT NULL, CHANGE Actif_U Actif_U INT DEFAULT 0 NOT NULL');
    }
}
