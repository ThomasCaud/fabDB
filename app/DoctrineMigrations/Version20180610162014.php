<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180610162014 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
    	$this->addSql("
            ALTER TABLE subsidiary_profil AUTO_INCREMENT = 1;

        	INSERT INTO subsidiary_profil (name,logo,description) VALUES
        	('avocat','fakelogo1.png','description 1'),
        	('directeur','fakelogo2.png','description 2'),
        	('défenseur','fakelogo3.png','description 3');

        	UPDATE personnality SET subprofil_id = 1 where personnality.id = 1;
        	UPDATE personnality SET subprofil_id = 2 where personnality.id = 2;
        	UPDATE personnality SET subprofil_id = 3 where personnality.id = 3;
        ");
    }

    public function down(Schema $schema) : void
    {

        $this->addSQL("
        	UPDATE personnality SET subprofil_id = NULL where personnality.id = 1;
        	UPDATE personnality SET subprofil_id = NULL where personnality.id = 2;
        	UPDATE personnality SET subprofil_id = NULL where personnality.id = 3;
        	DELETE from subprofil_id WHERE personnality.id <= 3;
        ");
    }
}
