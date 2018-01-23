<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180123142632 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cost CHANGE isRegular isRegular TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE revenue CHANGE isRegular isRegular TINYINT(1) DEFAULT \'0\'');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cost CHANGE isRegular isRegular TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE revenue CHANGE isRegular isRegular TINYINT(1) DEFAULT NULL');
    }
}
