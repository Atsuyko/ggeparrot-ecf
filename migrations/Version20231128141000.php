<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231128141000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car CHANGE teaser_img teaser_img VARCHAR(255) DEFAULT NULL, CHANGE img1 img1 VARCHAR(255) DEFAULT NULL, CHANGE img2 img2 VARCHAR(255) DEFAULT NULL, CHANGE img3 img3 VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car CHANGE teaser_img teaser_img VARCHAR(100) NOT NULL, CHANGE img1 img1 VARCHAR(100) NOT NULL, CHANGE img2 img2 VARCHAR(100) NOT NULL, CHANGE img3 img3 VARCHAR(100) NOT NULL');
    }
}
