<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180427121659 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders ADD user_id INT DEFAULT NULL, ADD is_paid TINYINT(1) DEFAULT \'0\' NOT NULL, ADD amount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, DROP status_of_pay, DROP user, DROP order_price, CHANGE status status SMALLINT DEFAULT 0 NOT NULL, CHANGE time_of_creation created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEEA76ED395 ON orders (user_id)');
        $this->addSql('ALTER TABLE order_items ADD product_id INT DEFAULT NULL, ADD quantity INT DEFAULT 0 NOT NULL, ADD amount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, DROP product, DROP quantity_of_ordered_items, DROP value, CHANGE price price NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB04584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('CREATE INDEX IDX_62809DB04584665A ON order_items (product_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_items DROP FOREIGN KEY FK_62809DB04584665A');
        $this->addSql('DROP INDEX IDX_62809DB04584665A ON order_items');
        $this->addSql('ALTER TABLE order_items ADD product VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD quantity_of_ordered_items NUMERIC(2, 0) NOT NULL, ADD value NUMERIC(10, 2) DEFAULT NULL, DROP product_id, DROP quantity, DROP amount, CHANGE price price NUMERIC(10, 2) DEFAULT NULL');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('DROP INDEX IDX_E52FFDEEA76ED395 ON orders');
        $this->addSql('ALTER TABLE orders ADD status_of_pay VARCHAR(5) NOT NULL COLLATE utf8mb4_unicode_ci, ADD user VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD order_price NUMERIC(10, 2) DEFAULT NULL, DROP user_id, DROP is_paid, DROP amount, CHANGE status status VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE created_at time_of_creation DATETIME NOT NULL');
    }
}
