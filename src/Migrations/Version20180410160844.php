<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180410160844 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_items (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, product VARCHAR(255) NOT NULL, quantity_of_ordered_items NUMERIC(2, 0) NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, value NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_62809DB08D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_items ADD CONSTRAINT FK_62809DB08D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('ALTER TABLE products CHANGE is_top is_top TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, order_id INT DEFAULT NULL, product VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quantity_of_ordered_items NUMERIC(2, 0) NOT NULL, price NUMERIC(10, 2) DEFAULT NULL, value NUMERIC(10, 2) DEFAULT NULL, INDEX IDX_52EA1F098D9F6D38 (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F098D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('DROP TABLE order_items');
        $this->addSql('ALTER TABLE products CHANGE is_top is_top TINYINT(1) DEFAULT NULL');
    }
}
