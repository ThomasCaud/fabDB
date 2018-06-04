<?php declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180604174532 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO category (name) VALUES
            ('Electronique'),
            ('Décoration'),
            ('Transport'),
            ('Bijoux'),
            ('Autres')
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSQL("DELETE * from category
            WHERE name = 'Electronique'
            OR name = 'Décoration'
            OR name = 'Transport'
            OR name = 'Bijoux'
            OR name = 'Autres'
        ");
    }
}
