<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260203090703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product RENAME INDEX name_product TO UNIQ_D34A04ADDB214113');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FB1AD3FC8680000C ON seller (email_seller)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product RENAME INDEX uniq_d34a04addb214113 TO name_product');
        $this->addSql('DROP INDEX UNIQ_FB1AD3FC8680000C ON seller');
    }
}
