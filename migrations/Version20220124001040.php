<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220124001040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collecting (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, collecting_id INT NOT NULL, title VARCHAR(255) NOT NULL, synopsis LONGTEXT DEFAULT NULL, chapters INT NOT NULL, volumes_or_episodes INT NOT NULL, start_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', image_url VARCHAR(510) DEFAULT NULL, INDEX IDX_1F1B251E112130C7 (collecting_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_category (item_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_6A41D10A126F525E (item_id), INDEX IDX_6A41D10A12469DE2 (category_id), PRIMARY KEY(item_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, date_of_birth DATETIME NOT NULL, modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_collecting (user_id INT NOT NULL, collecting_id INT NOT NULL, INDEX IDX_3BED2A3BA76ED395 (user_id), INDEX IDX_3BED2A3B112130C7 (collecting_id), PRIMARY KEY(user_id, collecting_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_item (user_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_659A69D7A76ED395 (user_id), INDEX IDX_659A69D7126F525E (item_id), PRIMARY KEY(user_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E112130C7 FOREIGN KEY (collecting_id) REFERENCES collecting (id)');
        $this->addSql('ALTER TABLE item_category ADD CONSTRAINT FK_6A41D10A126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_category ADD CONSTRAINT FK_6A41D10A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_collecting ADD CONSTRAINT FK_3BED2A3BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_collecting ADD CONSTRAINT FK_3BED2A3B112130C7 FOREIGN KEY (collecting_id) REFERENCES collecting (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_item ADD CONSTRAINT FK_659A69D7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_item ADD CONSTRAINT FK_659A69D7126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_category DROP FOREIGN KEY FK_6A41D10A12469DE2');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E112130C7');
        $this->addSql('ALTER TABLE user_collecting DROP FOREIGN KEY FK_3BED2A3B112130C7');
        $this->addSql('ALTER TABLE item_category DROP FOREIGN KEY FK_6A41D10A126F525E');
        $this->addSql('ALTER TABLE user_item DROP FOREIGN KEY FK_659A69D7126F525E');
        $this->addSql('ALTER TABLE user_collecting DROP FOREIGN KEY FK_3BED2A3BA76ED395');
        $this->addSql('ALTER TABLE user_item DROP FOREIGN KEY FK_659A69D7A76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE collecting');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_collecting');
        $this->addSql('DROP TABLE user_item');
    }
}
