<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503114357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destinations_categories (destinations_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_61B1CB52912C90D4 (destinations_id), INDEX IDX_61B1CB52A21214B7 (categories_id), PRIMARY KEY(destinations_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destinations_categories ADD CONSTRAINT FK_61B1CB52912C90D4 FOREIGN KEY (destinations_id) REFERENCES destinations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations_categories ADD CONSTRAINT FK_61B1CB52A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE destinations ADD pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE destinations ADD CONSTRAINT FK_2D3343C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_2D3343C3A6E44244 ON destinations (pays_id)');
        $this->addSql('ALTER TABLE form_reservation ADD destinations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE form_reservation ADD CONSTRAINT FK_B5A3D944912C90D4 FOREIGN KEY (destinations_id) REFERENCES destinations (id)');
        $this->addSql('CREATE INDEX IDX_B5A3D944912C90D4 ON form_reservation (destinations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE destinations_categories DROP FOREIGN KEY FK_61B1CB52912C90D4');
        $this->addSql('ALTER TABLE destinations_categories DROP FOREIGN KEY FK_61B1CB52A21214B7');
        $this->addSql('DROP TABLE destinations_categories');
        $this->addSql('ALTER TABLE destinations DROP FOREIGN KEY FK_2D3343C3A6E44244');
        $this->addSql('DROP INDEX IDX_2D3343C3A6E44244 ON destinations');
        $this->addSql('ALTER TABLE destinations DROP pays_id');
        $this->addSql('ALTER TABLE form_reservation DROP FOREIGN KEY FK_B5A3D944912C90D4');
        $this->addSql('DROP INDEX IDX_B5A3D944912C90D4 ON form_reservation');
        $this->addSql('ALTER TABLE form_reservation DROP destinations_id');
    }
}
