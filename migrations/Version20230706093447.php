<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706093447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY fk_id_user');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY fk_id_user');
        $this->addSql('ALTER TABLE question CHANGE Vote_Q Vote_Q INT NOT NULL, CHANGE Signale_Q Signale_Q INT NOT NULL, CHANGE Id_U id_U INT DEFAULT NULL, CHANGE Titre_Q Titre_Q TEXT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EE96E089 FOREIGN KEY (id_U) REFERENCES utilisateur (id_U)');
        $this->addSql('DROP INDEX fk_id_user ON question');
        $this->addSql('CREATE INDEX IDX_B6F7494EE96E089 ON question (id_U)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk_id_user FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_q');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_u');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_q');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY fk_id_u');
        $this->addSql('ALTER TABLE reponse CHANGE Contenu_R contenu_r VARCHAR(150) NOT NULL, CHANGE Date_Ajout_R date_ajout_r DATETIME NOT NULL, CHANGE Vote_R vote_r INT NOT NULL, CHANGE Etat_R etat_r INT NOT NULL, CHANGE Signale_R signale_r INT NOT NULL, CHANGE Id_Q Id_Q INT DEFAULT NULL, CHANGE Id_U id_U INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A9C98BAE FOREIGN KEY (Id_Q) REFERENCES question (id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7E96E089 FOREIGN KEY (id_U) REFERENCES utilisateur (id_U)');
        $this->addSql('DROP INDEX fk_id_q ON reponse');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7A9C98BAE ON reponse (Id_Q)');
        $this->addSql('DROP INDEX fk_id_u ON reponse');
        $this->addSql('CREATE INDEX IDX_5FB6DEC7E96E089 ON reponse (id_U)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_q FOREIGN KEY (Id_Q) REFERENCES question (Id_Q) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_u FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE Role_U Role_U INT NOT NULL, CHANGE Verifie_U Verifie_U INT NOT NULL, CHANGE Actif_U Actif_U INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EE96E089');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EE96E089');
        $this->addSql('ALTER TABLE question CHANGE Titre_Q Titre_Q VARCHAR(50) NOT NULL, CHANGE Vote_Q Vote_Q INT DEFAULT 0 NOT NULL, CHANGE Signale_Q Signale_Q INT DEFAULT 0 NOT NULL, CHANGE id_U Id_U INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT fk_id_user FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_b6f7494ee96e089 ON question');
        $this->addSql('CREATE INDEX fk_id_user ON question (Id_U)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EE96E089 FOREIGN KEY (id_U) REFERENCES utilisateur (id_U)');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A9C98BAE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7E96E089');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A9C98BAE');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7E96E089');
        $this->addSql('ALTER TABLE reponse CHANGE contenu_r Contenu_R TEXT NOT NULL, CHANGE date_ajout_r Date_Ajout_R DATE NOT NULL, CHANGE vote_r Vote_R INT DEFAULT 0 NOT NULL, CHANGE etat_r Etat_R INT DEFAULT 0 NOT NULL, CHANGE signale_r Signale_R INT DEFAULT 0 NOT NULL, CHANGE Id_Q Id_Q INT NOT NULL, CHANGE id_U Id_U INT NOT NULL');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_q FOREIGN KEY (Id_Q) REFERENCES question (Id_Q) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT fk_id_u FOREIGN KEY (Id_U) REFERENCES utilisateur (Id_U) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_5fb6dec7e96e089 ON reponse');
        $this->addSql('CREATE INDEX fk_id_u ON reponse (Id_U)');
        $this->addSql('DROP INDEX idx_5fb6dec7a9c98bae ON reponse');
        $this->addSql('CREATE INDEX fk_id_q ON reponse (Id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A9C98BAE FOREIGN KEY (Id_Q) REFERENCES question (id_Q)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7E96E089 FOREIGN KEY (id_U) REFERENCES utilisateur (id_U)');
        $this->addSql('ALTER TABLE utilisateur DROP roles, CHANGE Role_U Role_U INT DEFAULT 0 NOT NULL, CHANGE Verifie_U Verifie_U INT DEFAULT 0 NOT NULL, CHANGE Actif_U Actif_U INT DEFAULT 0 NOT NULL');
    }
}
