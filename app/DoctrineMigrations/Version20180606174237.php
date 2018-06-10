<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180606174237 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("
            ALTER TABLE purchase AUTO_INCREMENT = 1
        ");

        $this->addSql("
            INSERT INTO purchase (command_id,quantity,price,product_id) VALUES
            (1,2,10.5,1),
            (1,4,9.99,1),
            (1,8,12.5,1),
            (2,5,15.5,2),
            (2,10,99.99,2)
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSQL("DELETE from purchase WHERE Id <= 5");
    }
}
