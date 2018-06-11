<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180610105131 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
    	$this->addSql("
    		UPDATE purchase SET product_id = 2 WHERE id = 2;
    	");

    	$this->addSql("
    		UPDATE purchase SET product_id = 3 WHERE id = 3;
    	");
    }

    public function down(Schema $schema) : void
    {
    	$this->addSql("
    		UPDATE purchase SET product_id = 1 WHERE id = 2;
    	");

    	$this->addSql("
    		UPDATE purchase SET product_id = 1 WHERE id = 3;
    	");
    }
}
