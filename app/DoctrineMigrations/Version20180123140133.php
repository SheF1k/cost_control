<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180123140133 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cost (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cost_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, sum DOUBLE PRECISION NOT NULL, creationDate DATETIME NOT NULL, isRegular TINYINT(1) DEFAULT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_182694FCA76ED395 (user_id), INDEX IDX_182694FC832204AC (cost_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cost ADD CONSTRAINT FK_182694FCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cost ADD CONSTRAINT FK_182694FC832204AC FOREIGN KEY (cost_type_id) REFERENCES cost_type (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cost');
    }
}
