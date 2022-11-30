<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130210623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD slug VARCHAR(255) NOT NULL, CHANGE order_number order_number VARCHAR(255) NOT NULL, CHANGE itemcount itemcount INT NOT NULL, CHANGE account_name account_name VARCHAR(255) NOT NULL, CHANGE pays pays VARCHAR(255) NOT NULL, CHANGE zipcode zipcode VARCHAR(255) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE item_index item_index VARCHAR(255) NOT NULL, CHANGE item_id item_id VARCHAR(255) NOT NULL, CHANGE item_quantity item_quantity INT NOT NULL, CHANGE prix_htva prix_htva DOUBLE PRECISION NOT NULL, CHANGE prix_tva prix_tva DOUBLE PRECISION NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP slug, CHANGE order_number order_number VARCHAR(255) DEFAULT NULL, CHANGE itemcount itemcount INT DEFAULT NULL, CHANGE account_name account_name VARCHAR(255) DEFAULT NULL, CHANGE pays pays VARCHAR(255) DEFAULT NULL, CHANGE zipcode zipcode VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE item_index item_index VARCHAR(255) DEFAULT NULL, CHANGE item_id item_id VARCHAR(255) DEFAULT NULL, CHANGE item_quantity item_quantity INT DEFAULT NULL, CHANGE prix_htva prix_htva DOUBLE PRECISION DEFAULT NULL, CHANGE prix_tva prix_tva DOUBLE PRECISION DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL');
    }
}
