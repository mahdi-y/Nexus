<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230621133807 extends AbstractMigration
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
        $this->addSql('ALTER TABLE question CHANGE Contenu_Q contenu_q VARCHAR(150) NOT NULL, CHANGE Type_Q type_q VARCHAR(150) NOT NULL, CHANGE Date_Ajout_Q date_ajout_q DATETIME NOT NULL, CHANGE Vote_Q vote_q INT NOT NULL, CHANGE Signale_Q signale_q INT NOT NULL, CHANGE Id_U id_u INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E35F8C041 FOREIGN KEY (id_u) REFERENCES utilisateur (id_u)');
        $this->addSql('DROP INDEX fk_id_u2 ON question');
        $this->addSql('CREATE INDEX IDX_B6F7494E35F8C041 ON question (id_u)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk_id_u2 FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_u');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_q');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_u');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_q');
        $this->addSql('ALTER TABLE reponse CHANGE Contenu_R contenu_r VARCHAR(150) NOT NULL, CHANGE Date_Ajout_R date_ajout_r DATETIME NOT NULL, CHANGE Vote_R vote_r INT NOT NULL, CHANGE Etat_R etat_r INT NOT NULL, CHANGE Signale_R signale_r INT NOT NULL, CHANGE Id_Q Id_Q INT DEFAULT NULL, CHANGE Id_U id_u INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A9C98BAE FOREIGN KEY (Id_Q) REFERENCES question (id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC735F8C041 FOREIGN KEY (id_u) REFERENCES utilisateur (id_u)');
        $this->addSql('DROP INDEX fk_id_q ON reponse');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7A9C98BAE ON reponse (Id_Q)');
        $this->addSql('DROP INDEX fk_id_u ON reponse');
        $this->addSql('CREATE INDEX IDX_5FB6DEC735F8C041 ON reponse (id_u)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_u FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_q FOREIGN KEY (Id_Q) REFERENCES question (Id_Q) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur CHANGE Nom_U nom_u VARCHAR(150) NOT NULL, CHANGE Prenom_U prenom_u VARCHAR(150) NOT NULL, CHANGE Email_U email_u VARCHAR(150) NOT NULL, CHANGE Date_Naissance_U date_naissance_u DATETIME NOT NULL, CHANGE Sexe_U sexe_u VARCHAR(150) NOT NULL, CHANGE Mdp mdp INT NOT NULL, CHANGE Role_U role_u INT NOT NULL, CHANGE Verifie_U verifie_u INT NOT NULL, CHANGE Actif_U actif_u INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E35F8C041');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E35F8C041');
        $this->addSql('ALTER TABLE question CHANGE id_u Id_U INT NOT NULL, CHANGE contenu_q Contenu_Q TEXT NOT NULL, CHANGE type_q Type_Q VARCHAR(40) NOT NULL, CHANGE date_ajout_q Date_Ajout_Q DATE NOT NULL, CHANGE vote_q Vote_Q INT DEFAULT 0 NOT NULL, CHANGE signale_q Signale_Q INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk_id_u2 FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_b6f7494e35f8c041 ON question');
        $this->addSql('CREATE INDEX fk_id_u2 ON question (Id_U)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E35F8C041 FOREIGN KEY (id_u) REFERENCES utilisateur (id_u)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A9C98BAE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC735F8C041');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A9C98BAE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC735F8C041');
        $this->addSql('ALTER TABLE reponse CHANGE id_u Id_U INT NOT NULL, CHANGE contenu_r Contenu_R TEXT NOT NULL, CHANGE date_ajout_r Date_Ajout_R DATE NOT NULL, CHANGE vote_r Vote_R INT DEFAULT 0 NOT NULL, CHANGE etat_r Etat_R INT DEFAULT 0 NOT NULL, CHANGE signale_r Signale_R INT DEFAULT 0 NOT NULL, CHANGE Id_Q Id_Q INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_u FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_q FOREIGN KEY (Id_Q) REFERENCES question (Id_Q) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_5fb6dec735f8c041 ON reponse');
        $this->addSql('CREATE INDEX fk_id_u ON reponse (Id_U)');
        $this->addSql('DROP INDEX idx_5fb6dec7a9c98bae ON reponse');
        $this->addSql('CREATE INDEX fk_id_q ON reponse (Id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A9C98BAE FOREIGN KEY (Id_Q) REFERENCES question (id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC735F8C041 FOREIGN KEY (id_u) REFERENCES utilisateur (id_u)');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom_u Nom_U VARCHAR(20) NOT NULL, CHANGE prenom_u Prenom_U VARCHAR(20) NOT NULL, CHANGE email_u Email_U VARCHAR(50) NOT NULL, CHANGE mdp Mdp VARCHAR(64) NOT NULL, CHANGE date_naissance_u Date_Naissance_U DATE NOT NULL, CHANGE sexe_u Sexe_U VARCHAR(20) NOT NULL, CHANGE role_u Role_U INT DEFAULT 0 NOT NULL, CHANGE verifie_u Verifie_U INT DEFAULT 0 NOT NULL, CHANGE actif_u Actif_U INT DEFAULT 0 NOT NULL');
    }
}
