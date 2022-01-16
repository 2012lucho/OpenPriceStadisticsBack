<?php

use yii\db\Migration;

/**
 * Class m220113_170059_create_couta_for_enterprice_item
 */
class m220113_170059_create_couta_for_enterprice_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('public_service',
            [   
                'id'          => 12,
                'name'        => 'enterprice_item', 
                'description' => 'Rubros Comerciales',
                'controller'  => 'PublicEnterpriceItemController',
                'action'      => '*',
                'method'      => '*'
            ]);
        $this->insert('public_service_couta',
            [ 
                'id'                => 12,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 12
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220113_170059_create_couta_for_enterprice_item cannot be reverted.\n";

        return false;
    }

}
