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
        $this->addSql("
            ALTER TABLE category AUTO_INCREMENT = 1
        ");

        $this->addSql("
            INSERT INTO category (name) VALUES
            ('Electronique'),
            ('Décoration'),
            ('Transport'),
            ('Bijoux'),
            ('Autres')
        ");

        $this->addSql("
            ALTER TABLE fablab AUTO_INCREMENT = 1
        ");
        $this->addSql("
            INSERT INTO fablab (address, PC, city) VALUES
            ('139 Rue des Arts, Bâtiment C, 1er étage', 59100, 'Roubaix'),
            ('57 Avenue de Landshut', 60200, 'Compiegne')
        ");

        $this->addSql("
            ALTER TABLE users AUTO_INCREMENT = 1
        ");
        $this->addSql("
            INSERT INTO users (fname, lname, email,login) VALUES
            ('Thomas','Caudrelier','tcaudrel@etu.utc.fr','tcaudrel'),
            ('Maxime','Lucas','lucasmax@etu.utc.fr','lucasmax')
        ");

        $this->addSql("
            ALTER TABLE product AUTO_INCREMENT = 1
        ");
        $this->addSql("
            INSERT INTO product (maker_id,category_id,name,description,price,discount,stock,publication) VALUES
            (1,1,'Produit 1 name','Description produit 1', 15.5, 1,15,'2018-05-18'),
            (1,2,'Produit 2 name','Description produit 2', 7.99, 1,6,'2018-05-20'),
            (2,2,'Produit 1 name','Description produit 3', 10.5, 1,9,'2018-06-05')
        ");

        $this->addSql("
            ALTER TABLE url AUTO_INCREMENT = 1
        ");
        $this->addSql("
            INSERT INTO url (product_id, type, URL) VALUES
            (1,'photo','www.myphoto/12121'),
            (1,'video','www.myvideo/21545'),
            (2,'video','www.myvideo/9521'),
            (3,'video','www.myvideo/5121'),
            (3,'video','www.myvideo/5122')
        ");
        $this->addSql("
            INSERT INTO users_fablab (fablab_id,user_id,joined_at,role) VALUES
            (1,1,'2018-05-18','maker'),
            (1,2,'2018-05-18','client'),
            (2,1,'2018-05-18','admin'),
            (2,2,'2018-05-18','maker')
        ");
    }

    public function down(Schema $schema) : void
    {
        $this->addSQL("DELETE from users_fablab
            WHERE user_id = 1
            OR user_id = 2
        ");

        $this->addSQL("DELETE from fablab
            WHERE address = '139 Rue des Arts, Bâtiment C, 1er étage'
            OR address = '57 Avenue de Landshut'
        ");

        $this->addSQL("DELETE from url");

        $this->addSQL("DELETE from product
            WHERE name='Produit 1 name'
            OR name='Produit 2 name'
            OR name='Produit 3 name'
        ");

        $this->addSQL("DELETE from category
            WHERE name = 'Electronique'
            OR name = 'Décoration'
            OR name = 'Transport'
            OR name = 'Bijoux'
            OR name = 'Autres'
        ");

        $this->addSQL("DELETE from users
            WHERE login = 'tcaudrel'
            OR login = 'lucasmax'
        ");
    }
}
