<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180607063724 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("
            INSERT INTO connected_object (name) VALUES
            ('Montre connectée'),
            ('Lunettes à réalité augmentée'),
            ('Lentille de contact intelligente'),
            ('Miroir interactif')
        ");

        $this->addSql("
        	INSERT INTO access (user_id, connected_object_id, type) VALUES
        	(1,1,'Normal'),
        	(1,2,'Premium'),
        	(2,2,'Premium'),
        	(2,1,'Admin')
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSQL("DELETE from access");
        $this->addSQL("DELETE from connected_object");
    }
}
