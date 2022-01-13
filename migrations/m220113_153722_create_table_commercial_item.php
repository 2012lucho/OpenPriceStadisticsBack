<?php

use yii\db\Migration;

/**
 * Class m220113_153722_create_table_commercial_item
 */
class m220113_153722_create_table_commercial_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Creación de tablas relacionadas a los rubros comerciales
        $this->createTable('commercial_item', [
            'id'    => $this->primaryKey(),
            'name'  => $this->string()->notNull(),
            'icon'  => $this->string()
        ]);

        $this->insert('commercial_item', [ 'id'   => 1, 'name' => 'Panadería', 'icon' => '' ]);
        $this->insert('commercial_item', [ 'id'   => 2, 'name' => 'Rotisería', 'icon' => '' ]);
        $this->insert('commercial_item', [ 'id'   => 3, 'name' => 'Frutería y Verdulería', 'icon' => '' ]);
        $this->insert('commercial_item', [ 'id'   => 4, 'name' => 'Carnicería', 'icon' => '' ]);
        $this->insert('commercial_item', [ 'id'   => 5, 'name' => 'Ferretería', 'icon' => '' ]);
        $this->insert('commercial_item', [ 'id'   => 6, 'name' => 'Supermercado', 'icon' => '' ]);
        $this->insert('commercial_item', [ 'id'   => 7, 'name' => 'Heladería', 'icon' => '' ]);

        $this->createTable('enterprice_commercial_item', [
            'id'                 => $this->primaryKey(),
            'id_enterprice'      => $this->integer()->notNull(),
            'id_commercial_item' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'enterprice_commercial_item_1', 
            'enterprice_commercial_item','id_enterprice', 
            'enterprice','id'
        );

        $this->addForeignKey(
            'enterprice_commercial_item_2', 
            'enterprice_commercial_item','id_commercial_item', 
            'commercial_item','id'
        );

        //definicion de cuota de uso del servicio
        $this->insert('public_service',
            [   
                'id'          => 11,
                'name'        => 'enterprice_commercial_item', 
                'description' => 'Empresas por rubro comercial',
                'controller'  => 'PublicEnterpriceItemController',
                'action'      => '*',
                'method'      => '*'
            ]);
        $this->insert('public_service_couta',
            [ 
                'id'                => 11,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 11
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220113_153722_create_table_commercial_item cannot be reverted.\n";

        return false;
    }
}
