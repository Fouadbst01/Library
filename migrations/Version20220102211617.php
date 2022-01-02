<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220102211617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur_livre (auteur_id INT NOT NULL, livre_id INT NOT NULL, INDEX IDX_A6DFA5E060BB6FE6 (auteur_id), INDEX IDX_A6DFA5E037D925CB (livre_id), PRIMARY KEY(auteur_id, livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_genre (livre_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_1053AB9E37D925CB (livre_id), INDEX IDX_1053AB9E4296D31F (genre_id), PRIMARY KEY(livre_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE auteur_livre ADD CONSTRAINT FK_A6DFA5E060BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE auteur_livre ADD CONSTRAINT FK_A6DFA5E037D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_genre ADD CONSTRAINT FK_1053AB9E37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_genre ADD CONSTRAINT FK_1053AB9E4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE ecrire');
        $this->addSql('ALTER TABLE auteur CHANGE nom_prenom nom_prenom VARCHAR(255) NOT NULL, CHANGE sexe sexe VARCHAR(1) DEFAULT NULL, CHANGE nationnalite nationalite VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE livre DROP FOREIGN KEY FK_AC634F99124D3F8A');
        $this->addSql('DROP INDEX IDX_AC634F99124D3F8A ON livre');
        $this->addSql('ALTER TABLE livre DROP id_genre_id, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE nombre_payes nombre_pages NUMERIC(20, 0) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ecrire (id INT AUTO_INCREMENT NOT NULL, id_livre_id INT NOT NULL, id_auteur_id INT NOT NULL, INDEX IDX_918824CC6702C95E (id_livre_id), INDEX IDX_918824CCE08ED3C1 (id_auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE ecrire ADD CONSTRAINT FK_918824CCE08ED3C1 FOREIGN KEY (id_auteur_id) REFERENCES auteur (id)');
        $this->addSql('ALTER TABLE ecrire ADD CONSTRAINT FK_918824CC6702C95E FOREIGN KEY (id_livre_id) REFERENCES livre (id)');
        $this->addSql('DROP TABLE auteur_livre');
        $this->addSql('DROP TABLE livre_genre');
        $this->addSql('ALTER TABLE auteur CHANGE nom_prenom nom_prenom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE sexe sexe VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nationalite nationnalite VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE livre ADD id_genre_id INT NOT NULL, CHANGE titre titre VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre_pages nombre_payes NUMERIC(20, 0) DEFAULT NULL');
        $this->addSql('ALTER TABLE livre ADD CONSTRAINT FK_AC634F99124D3F8A FOREIGN KEY (id_genre_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_AC634F99124D3F8A ON livre (id_genre_id)');
    }
}
