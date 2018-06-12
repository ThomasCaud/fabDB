<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180611201723 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
    	$this->addSQL('
    		INSERT INTO auth (login,password) VALUES 
    		(\'root\',\'$2y$12$JPGAWlwL9cSIQ3Clb5Jyh.p1GTd6w8A6m6vvpu4hllHw4J7MxcjbG\');
    	');
    }

    public function down(Schema $schema) : void
    {
      $this->addSql("
    		DELETE FROM auth WHERE login = 'root';
    	");
    }
}
