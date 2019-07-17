<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190710122045 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ingredient_quantity (id INT AUTO_INCREMENT NOT NULL, recipe_id INT NOT NULL, ingredient_id INT NOT NULL, quantity VARCHAR(255) NOT NULL, INDEX IDX_EDF546B859D8A214 (recipe_id), INDEX IDX_EDF546B8933FE08C (ingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, civility VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, mesure_unit VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, name VARCHAR(255) NOT NULL, preparation LONGTEXT NOT NULL, image1 VARCHAR(255) NOT NULL, image2 VARCHAR(255) DEFAULT NULL, image3 VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_DA88B137F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_68C58ED9A76ED395 (user_id), INDEX IDX_68C58ED959D8A214 (recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ingredient_quantity ADD CONSTRAINT FK_EDF546B859D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE ingredient_quantity ADD CONSTRAINT FK_EDF546B8933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED959D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137F675F31B');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('ALTER TABLE ingredient_quantity DROP FOREIGN KEY FK_EDF546B8933FE08C');
        $this->addSql('ALTER TABLE ingredient_quantity DROP FOREIGN KEY FK_EDF546B859D8A214');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED959D8A214');
        $this->addSql('DROP TABLE ingredient_quantity');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE favorite');
    }
}
