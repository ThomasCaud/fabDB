<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180607124208 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("
            INSERT INTO website (name,logo_url) VALUES
			('Facebook', 'https://cdn.pixabay.com/photo/2015/05/17/10/51/facebook-770688_960_720.png'),
			('Google maps', 'https://png.icons8.com/color/1600/google-maps.png'),
			('Gmail', 'https://png.icons8.com/color/1600/gmail.png'),
			('Slack', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Slack_Technologies_Logo.svg/2000px-Slack_Technologies_Logo.svg.png'),
			('Discord', 'https://vignette.wikia.nocookie.net/mogapedia/images/d/d0/Discord_logo.png/revision/latest?cb=20170531172957&path-prefix=fr'),
			('Netflix', 'http://www.stickpng.com/assets/images/580b57fcd9996e24bc43c529.png'),
			('Linkedin', 'https://www.freeiconspng.com/uploads/linkedin-logo-3.png'),
			('Drive', 'https://www.supinfo.com/articles/resources/208574/2217/0.png'),
			('Youtube', 'http://www.stickpng.com/assets/images/580b57fcd9996e24bc43c548.png')
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSQL("DELETE from website");
    }
}
