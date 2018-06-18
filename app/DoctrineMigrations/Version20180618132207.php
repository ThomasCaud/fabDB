<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180618132207 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("
            INSERT INTO comment (writer_id,product_id,note,comment,date) VALUES
            (1,1,5,'Produit arrivé sans emballage. Je suis déçu.','2018-06-18'),
            (1,2,15,'Mon chien s\'éclate déjà avec son nouveau chat en plastique à dévorer, merci au maker !','2018-06-18')
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("
            DELETE FROM comment WHERE id < 3;
        ");
    }
}
