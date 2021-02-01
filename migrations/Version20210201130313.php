<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201130313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE car_brands (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE car_cars (id VARCHAR(255) NOT NULL, brand_id VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, image_path VARCHAR(255) DEFAULT NULL, price_cent INT NOT NULL, INDEX IDX_5EAD09B844F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE car_cars ADD CONSTRAINT FK_5EAD09B844F5D008 FOREIGN KEY (brand_id) REFERENCES car_brands (id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_cars DROP FOREIGN KEY FK_5EAD09B844F5D008');
        $this->addSql('DROP TABLE car_brands');
        $this->addSql('DROP TABLE car_cars');
    }
}
