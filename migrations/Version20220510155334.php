<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510155334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auth_user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A3B536FDAA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE epreuves CHANGE duree duree VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiants CHANGE email email VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE inscriptions_epreuves CHANGE id_epreuve id_epreuve INT NOT NULL, CHANGE id_periode_ue id_periode_ue INT NOT NULL, CHANGE id_etudiant id_etudiant INT NOT NULL');
        $this->addSql('ALTER TABLE inscriptions_parcours CHANGE id_etudiant id_etudiant INT NOT NULL, CHANGE id_parcours id_parcours INT NOT NULL, CHANGE saisie saisie TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'booléen\'');
        $this->addSql('ALTER TABLE inscriptions_periodes CHANGE id_etudiant id_etudiant INT NOT NULL, CHANGE id_periode id_periode INT NOT NULL, CHANGE saisie saisie TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'booléen\', CHANGE inscription_partielle inscription_partielle TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'indique si l\'\'inscription concerne l\'\'ensemble des UEs de la période et donc si une note doit apparaître\'');
        $this->addSql('ALTER TABLE inscriptions_ues CHANGE id_etudiant id_etudiant INT NOT NULL, CHANGE id_periode_ue id_periode_ue INT NOT NULL, CHANGE saisie saisie TINYINT(1) DEFAULT 0 NOT NULL COMMENT \'booléen\'');
        $this->addSql('ALTER TABLE mentions CHANGE id_diplome id_diplome INT NOT NULL, CHANGE id_ufr id_ufr INT NOT NULL, CHANGE nom_court nom_court VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE mentions_parcours CHANGE id_mention id_mention INT NOT NULL, CHANGE id_parcours id_parcours INT NOT NULL');
        $this->addSql('ALTER TABLE parcours CHANGE id_periodicite id_periodicite INT NOT NULL, CHANGE nom_court nom_court VARCHAR(20) DEFAULT NULL, CHANGE code_apogee code_apogee VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE periodes CHANGE id_parcours id_parcours INT NOT NULL, CHANGE code_apogee code_apogee VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE periodes_ues CHANGE id_periode id_periode INT NOT NULL, CHANGE id_ue id_ue INT NOT NULL');
        $this->addSql('ALTER TABLE types_note CHANGE commentaire commentaire VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE types_resultat CHANGE commentaire commentaire VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE ues CHANGE nom_court nom_court VARCHAR(20) DEFAULT NULL, CHANGE code_apogee code_apogee VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE ufrs CHANGE id_universite id_universite INT NOT NULL, CHANGE denomination_courte denomination_courte VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE auth_user');
        $this->addSql('ALTER TABLE epreuves CHANGE duree duree VARCHAR(20) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE etudiants CHANGE email email VARCHAR(100) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE inscriptions_epreuves CHANGE id_epreuve id_epreuve INT DEFAULT NULL, CHANGE id_periode_ue id_periode_ue INT DEFAULT NULL, CHANGE id_etudiant id_etudiant INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inscriptions_parcours CHANGE id_etudiant id_etudiant INT DEFAULT NULL, CHANGE id_parcours id_parcours INT DEFAULT NULL, CHANGE saisie saisie TINYINT(1) NOT NULL COMMENT \'booléen\'');
        $this->addSql('ALTER TABLE inscriptions_periodes CHANGE id_etudiant id_etudiant INT DEFAULT NULL, CHANGE id_periode id_periode INT DEFAULT NULL, CHANGE saisie saisie TINYINT(1) NOT NULL COMMENT \'booléen\', CHANGE inscription_partielle inscription_partielle TINYINT(1) NOT NULL COMMENT \'indique si l\'\'inscription concerne l\'\'ensemble des UEs de la période et donc si une note doit apparaître\'');
        $this->addSql('ALTER TABLE inscriptions_ues CHANGE id_etudiant id_etudiant INT DEFAULT NULL, CHANGE id_periode_ue id_periode_ue INT DEFAULT NULL, CHANGE saisie saisie TINYINT(1) NOT NULL COMMENT \'booléen\'');
        $this->addSql('ALTER TABLE mentions CHANGE id_diplome id_diplome INT DEFAULT NULL, CHANGE id_ufr id_ufr INT DEFAULT NULL, CHANGE nom_court nom_court VARCHAR(20) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE mentions_parcours CHANGE id_mention id_mention INT DEFAULT NULL, CHANGE id_parcours id_parcours INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parcours CHANGE id_periodicite id_periodicite INT DEFAULT NULL, CHANGE nom_court nom_court VARCHAR(20) DEFAULT \'NULL\', CHANGE code_apogee code_apogee VARCHAR(30) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE periodes CHANGE id_parcours id_parcours INT DEFAULT NULL, CHANGE code_apogee code_apogee VARCHAR(30) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE periodes_ues CHANGE id_periode id_periode INT DEFAULT NULL, CHANGE id_ue id_ue INT DEFAULT NULL');
        $this->addSql('ALTER TABLE types_note CHANGE commentaire commentaire VARCHAR(100) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE types_resultat CHANGE commentaire commentaire VARCHAR(100) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE ues CHANGE nom_court nom_court VARCHAR(20) DEFAULT \'NULL\', CHANGE code_apogee code_apogee VARCHAR(30) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE ufrs CHANGE id_universite id_universite INT DEFAULT NULL, CHANGE denomination_courte denomination_courte VARCHAR(20) DEFAULT \'NULL\'');
    }
}
