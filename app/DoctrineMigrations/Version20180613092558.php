<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180613092558 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSQL('
    		INSERT INTO auth (login,password) VALUES 
    		(\'connectedobjects\',\'$2y$13$4ezZvcaX3XMxgZWX9JC7rufflm/vsq5fMHKHF97BbTv1ZzOJu4mAC\');
		');

    	$this->addSQL('INSERT INTO auth (login,password) VALUES 
    		(\'usersprofile\',\'$2y$13$AjHUmSqeNOFcVY5N7.2Yku0tsTB0D2JNjUjmiMve4OY2xrE.gJXES\');
		');

    	$this->addSQL('INSERT INTO auth (login,password) VALUES 
    		(\'marketplace\',\'$2y$13$MhmzjMHe3XqjMskOQMiBJuQsPfEcAnYAM0/gXqQ9KODuGhqV4q2JG\');
		');

    	$this->addSQL('INSERT INTO auth (login,password) VALUES 
    		(\'blockchain\',\'$2y$13$fi5n8WlxMwAAzotKR5FWZudUIeP804lBKS/WhC6a5cT.tKbrw/vOO\');
		');

    	$this->addSQL('INSERT INTO auth (login,password) VALUES 
    		(\'userscommunication\',\'$2y$13$YU7nt68EFZNbCGWa59Lwy.1cunoPCzo7e0jyr6RKG6xTaEAaqkLTq\');
		');
		
    	$this->addSQL('INSERT INTO auth (login,password) VALUES 
    		(\'userskills\',\'$2y$13$JLN807Ka/PFYeyIMtOB1.upIzyBgB0WoO9B2BDFuJkk3v7SekO7R.\');
    	');

    	$this->addSQL('
        	UPDATE auth SET password = \'$2y$13$Ra9fWPLow6bPyee5YzJK2OIWYyzVNfQbcfeNZi9v../iGobyZn6H6\' WHERE login = \'root\';
    	');

    }

    public function down(Schema $schema) : void
    {
        $this->addSQL('
    		DELETE FROM auth WHERE login IN (\'connectedobjects\',\'usersprofile\',\'marketplace\',\'blockchain\',\'userscommunication\',\'userskills\');
    	');

    	$this->addSQL('
        	UPDATE auth SET password = \'$2y$13$KQjDnfMz1SLQftEjbXbqI.7WpoY1Tu45f7Q//YC2CAeUEk5taeo2C\' WHERE login = \'root\';
    	');
    }
}
