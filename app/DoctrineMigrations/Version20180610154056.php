<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180610154056 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
    	$this->addSql("
            ALTER TABLE personnality AUTO_INCREMENT = 1;

        	INSERT INTO personnality (mind,energy,nature,tactical,identity,profil) VALUES
        	(25,50,75,100,50,'analyst'),
        	(35,10,100,50,14,'diplomat'),
        	(48,52,36,41,58,'explorer');

        	UPDATE users SET personnality_id = 1 where users.id = 1;
        	UPDATE users SET personnality_id = 2 where users.id = 2;
        	UPDATE users SET personnality_id = 3 where users.id = 3;
        ");
    }

    public function down(Schema $schema) : void
    {

        $this->addSQL("
        	UPDATE users SET personnality_id = NULL where users.id = 1;
        	UPDATE users SET personnality_id = NULL where users.id = 2;
        	UPDATE users SET personnality_id = NULL where users.id = 3;
        	DELETE from personnality WHERE personnality.id <= 3;
        ");
    }
}
