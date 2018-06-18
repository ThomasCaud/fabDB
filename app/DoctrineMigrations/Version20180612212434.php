<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180612212434 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSQL('
        	UPDATE auth SET password = \'$2y$13$KQjDnfMz1SLQftEjbXbqI.7WpoY1Tu45f7Q//YC2CAeUEk5taeo2C\' WHERE login = \'root\';
    	');
    }

    public function down(Schema $schema) : void
    {
       	$this->addSQL('
        	UPDATE auth SET password = \'$2y$12$JPGAWlwL9cSIQ3Clb5Jyh.p1GTd6w8A6m6vvpu4hllHw4J7MxcjbG\' WHERE login = \'root\';
    	');

    }
}
