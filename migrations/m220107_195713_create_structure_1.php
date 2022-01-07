<?php

use yii\db\Migration;

/**
 * Class m220107_195713_create_structure_1
 */
class m220107_195713_create_structure_1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('branch', [
            'id'              => $this->primaryKey(),
            'name'            => $this->string(),
            'latitude'        => $this->float(),
            'longitude'       => $this->float(),
            'address_road'    => $this->string(),
            'address_number'  => $this->string(),
            'enterprise_id'   => $this->integer()->notNull(),
        ]);

        $this->createTable('category', [
            'id'               => $this->primaryKey(),
            'root_category_id' => $this->integer(),
            'name'             => $this->string()->notNull()
        ]);

        $this->createTable('enterprice', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createTable('price', [
            'id'                => $this->primaryKey(),
            'product_id'        => $this->integer()->notNull(),
            'price'             => $this->float()->notNull(),
            'date_time'         => $this->datetime()->notNull(),
            'user_id'           => $this->integer(),
            'branch_id'         => $this->integer()->notNull(),
            'es_oferta'         => $this->integer()->notNull(),
            'porcentage_oferta' => $this->float(),
        ]);

        $this->createTable('products', [
            'id'        => $this->primaryKey(),
            'name'      => $this->string()->notNull(),
            'vendor_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('product_category', [
            'id'          => $this->primaryKey(),
            'product_id'  => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->createTable('vendor', [
            'id'             => $this->primaryKey(),
            'name'           => $this->string()->notNull(),
            'root_vendor_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'branch_ibfk_1', 
            'branch','enterprise_id', 
            'enterprice','id'
        );

        $this->addForeignKey(
            'category_ibfk_1', 
            'category','root_category_id', 
            'category','id'
        );

        $this->addForeignKey(
            'price_ibfk_1', 
            'price','branch_id', 
            'branch','id'
        );

        $this->addForeignKey(
            'price_ibfk_2', 
            'price','product_id', 
            'products','id'
        );

        $this->addForeignKey(
            'products_ibfk_1', 
            'products','vendor_id', 
            'vendor','id'
        );

        $this->addForeignKey(
            'product_category_ibfk_1', 
            'product_category','product_id', 
            'products','id'
        );

        $this->addForeignKey(
            'product_category_ibfk_2', 
            'product_category','category_id', 
            'category','id'
        );

        $this->addForeignKey(
            'vendor_ibfk_1', 
            'vendor','root_vendor_id', 
            'vendor','id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220107_195713_create_structure_1 cannot be reverted.\n";

        return false;
    }
}
