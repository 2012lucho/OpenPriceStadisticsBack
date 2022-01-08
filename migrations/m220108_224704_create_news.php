<?php

use yii\db\Migration;

/**
 * Class m220108_224704_create_news
 */
class m220108_224704_create_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('public_service',
            [   
                'id'          => 9,
                'name'        => 'all_newa', 
                'description' => 'Novedades / Actualizaciones',
                'controller'  => 'PublicNewsController',
                'action'      => '*',
                'method'      => '*'
            ]);

        $this->insert('public_service_couta',
            [ 
                'id'                => 9,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 9
            ]);

        $this->createTable('news', [
                'id'           => $this->primaryKey(),
                'text'         => $this->text(),
                'datetime'     => $this->datetime(),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220108_224704_create_news cannot be reverted.\n";

        return false;
    }
}
