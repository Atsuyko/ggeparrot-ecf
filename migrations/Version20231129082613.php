<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129082613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car_option (car_id INT NOT NULL, option_id INT NOT NULL, INDEX IDX_42EEEC42C3C6F69F (car_id), INDEX IDX_42EEEC42A7C41D6F (option_id), PRIMARY KEY(car_id, option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_option ADD CONSTRAINT FK_42EEEC42C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_option ADD CONSTRAINT FK_42EEEC42A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE option_car DROP FOREIGN KEY FK_C14336DAA7C41D6F');
        $this->addSql('ALTER TABLE option_car DROP FOREIGN KEY FK_C14336DAC3C6F69F');
        $this->addSql('DROP TABLE option_car');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE option_car (option_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_C14336DAA7C41D6F (option_id), INDEX IDX_C14336DAC3C6F69F (car_id), PRIMARY KEY(option_id, car_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE option_car ADD CONSTRAINT FK_C14336DAA7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE option_car ADD CONSTRAINT FK_C14336DAC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_option DROP FOREIGN KEY FK_42EEEC42C3C6F69F');
        $this->addSql('ALTER TABLE car_option DROP FOREIGN KEY FK_42EEEC42A7C41D6F');
        $this->addSql('DROP TABLE car_option');
    }
}
