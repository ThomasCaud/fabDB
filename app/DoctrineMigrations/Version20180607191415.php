<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180607191415 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
    	$this->addSql("
            ALTER TABLE portrait AUTO_INCREMENT = 1
        ");

        $this->addSql("
        	INSERT INTO portrait (about_me,goal,fear,challenge,frustration,hobby,other) VALUES
        	('Je viens de Bourg Palette','Devenir maître de la ligue','Tomber sur un magicarpe shiney','Attraper un Mew shiney','Quand Red me met en PLS','Attraper des pokémons','RAS')
        ");

        $this->addSql("
        	UPDATE users set portrait_id = 1 where users.id = 1;
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSQL("
        	UPDATE users set portrait_id = null where users.id = 1;
        ");
        $this->addSQL("DELETE from portrait");
    }
}
