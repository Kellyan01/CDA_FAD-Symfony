<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260203091942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, seller_id INT NOT NULL, INDEX IDX_97A0ADA38DE820D9 (seller_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ticket_product (ticket_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_DF865DFF700047D2 (ticket_id), INDEX IDX_DF865DFF4584665A (product_id), PRIMARY KEY (ticket_id, product_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA38DE820D9 FOREIGN KEY (seller_id) REFERENCES seller (id)');
        $this->addSql('ALTER TABLE ticket_product ADD CONSTRAINT FK_DF865DFF700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ticket_product ADD CONSTRAINT FK_DF865DFF4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA38DE820D9');
        $this->addSql('ALTER TABLE ticket_product DROP FOREIGN KEY FK_DF865DFF700047D2');
        $this->addSql('ALTER TABLE ticket_product DROP FOREIGN KEY FK_DF865DFF4584665A');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_product');
    }
}
