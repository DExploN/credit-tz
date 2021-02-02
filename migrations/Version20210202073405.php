<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210202073405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE credit_bits (id VARCHAR(255) NOT NULL, request_car_id VARCHAR(255) NOT NULL, request_initial_fee INT NOT NULL, request_ready_to_pay_monthly INT NOT NULL, request_credit_time INT NOT NULL, credit_term_total_payment INT NOT NULL, credit_term_monthly_fee INT NOT NULL, credit_term_interest_rate NUMERIC(3, 1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql('ALTER TABLE car_brands CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql(
            'ALTER TABLE car_cars CHANGE id id VARCHAR(255) NOT NULL, CHANGE brand_id brand_id VARCHAR(255) NOT NULL'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE credit_bits');
        $this->addSql(
            'ALTER TABLE car_brands CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`'
        );
        $this->addSql(
            'ALTER TABLE car_cars CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE brand_id brand_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`'
        );
    }
}
