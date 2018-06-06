<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180606133114 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("
            INSERT INTO command (purchaser_id,lastDigitCard,dateCommand,status,billingAddress,deliveryAddress) VALUES
            (1,341,'2018-06-18','pending','Adresse de facturation 1','Adresse de livraison 1'),
            (1,341,'2018-06-19','paid','Adresse de facturation 2','Adresse de livraison 2'),
            (2,579,'2018-05-18','cancelled','Adresse de facturation 3','Adresse de livraison 3'),
            (2,579,'2015-04-18','pending','Adresse de facturation 4','Adresse de livraison 4')
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSQL("DELETE from command");
    }
}
