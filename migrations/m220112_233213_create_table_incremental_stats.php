<?php

use yii\db\Migration;

/**
 * Class m220112_233213_create_table_incremental_stats
 */
class m220112_233213_create_table_incremental_stats extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Se crea la tabla
        $this->createTable('incremental_stats', [
            'id'           => $this->primaryKey(),
            'key'          => $this->string()->notNull(),
            'description'  => $this->string()->notNull(),
            'value'        => $this->string()->notNull(),
        ]);

        $rows = (new \yii\db\Query())->select('id')->from('enterprice')->all();
        $this->insert('incremental_stats',
            [ 
                'id'          => 1,
                'key'         => 'cant_enterprice', 
                'description' => 'Comercios Registrados',
                'value'       => count($rows)
            ]);

        $rows = (new \yii\db\Query())->select('id')->from('price')->all();
        $this->insert('incremental_stats',
            [ 
                'id'          => 2,
                'key'         => 'cant_price', 
                'description' => 'Precios Registrados',
                'value'       => count($rows)
            ]);

        $rows = (new \yii\db\Query())->select('id')->from('products')->all();
        $this->insert('incremental_stats',
            [ 
                'id'          => 3,
                'key'         => 'cant_prod', 
                'description' => 'Productos Registrados',
                'value'       => count($rows)
            ]);

        //Cuota de uso
        $this->insert('public_service',
            [   
                'id'          => 10,
                'name'        => 'incremental_stats', 
                'description' => 'Estadisticas incrementales',
                'controller'  => 'PublicIncrementalStatsController',
                'action'      => '*',
                'method'      => '*'
            ]);
        $this->insert('public_service_couta',
            [ 
                'id'                => 10,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 10
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220112_233213_create_table_incremental_stats cannot be reverted.\n";

        return false;
    }

}
