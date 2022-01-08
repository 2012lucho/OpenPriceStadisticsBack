<?php

use yii\db\Migration;

/**
 * Class m220108_020220_autentication_tables
 */
class m220108_020220_autentication_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Tablas de cuotas de uso de servicios
        $this->createTable('public_input_history', [
            'id'                => $this->primaryKey(),
            'client_ip4'        => $this->string()->notNull(),
            'client_ip6'        => $this->string()->notNull(),
            'cookie_session'    => $this->text()->notNull(),
            'datetime'          => $this->dateTime()->notNull(),
            'public_service_id' => $this->integer()
        ]);

        $this->createTable('public_service', [
            'id'             => $this->primaryKey(),
            'name'           => $this->string()->notNull(),
            'description'    => $this->string()->notNull(),
            'controller'     => $this->string()->notNull(),
            'method'         => $this->string(),
            'action'         => $this->string()
        ]);

        $this->addForeignKey(
            'fk-public_service-public_service_id',
            'public_input_history',
            'public_service_id',
            'public_service',
            'id',
            'CASCADE'
        );

        $this->createTable('public_service_couta_meter', [
            'id'                 => $this->primaryKey(),
            'cod'                => $this->string()->notNull(),
            'description'        => $this->string()->notNull(),
            'time_lapse_seconds' => $this->integer()->notNull(),
            'amount'             => $this->integer()->notNull(),
        ]);

        $this->createTable('public_service_couta', [
            'id'                 => $this->primaryKey(),
            'id_cuota_meter'     => $this->integer()->notNull(),
            'id_public_service'  => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-public_service_cm-public_service_cm_id',
            'public_service_couta',
            'id_cuota_meter',
            'public_service_couta_meter',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-public_service_ps-public_service_ps_id',
            'public_service_couta',
            'id_public_service',
            'public_service',
            'id',
            'CASCADE'
        );

        //Tablas de datos de usuario
        $this->createTable('role', [
            'id'            => $this->primaryKey(),
            'type'          => $this->string(45)->notNull(),
        ]);

        $this->createTable('profile', [
            'id'           => $this->primaryKey(),
            'name'         => $this->string(59),
            'last_name'    => $this->string(50),
            'img_url'      => $this->string(200),
        ]);

        $this->createTable('user', [
            'id'                     => $this->primaryKey(),
            'username'               => $this->string(45),
            'password_hash'          => $this->string(255),
            'password_reset_token'   => $this->string(255),
            'access_token'           => $this->string(128),
            'created_at'             => $this->string(45),
            'updated_at'             => $this->string(45),
            'status'                 => $this->integer(1)->notNull(),
            'role_id'                => $this->integer()->notNull(),
            'profile_id'             => $this->integer()->notNull(),
        ]);
        $this->createIndex('fk_user_role_id', 'user', 'role_id');
        $this->addForeignKey(
            'fk_user_profile_id',
            'user',
            'profile_id',
            'profile',
            'id'
        );

        $this->addForeignKey(
            'fk_user_role_id',
            'user','role_id',
            'role','id'
        );

        //Registros de usuarios
        $this->insert('profile',  [ 'id'  => 1, 'name' => 'administrador', 'last_name' => 'base' ]);
        $this->insert('profile',  [ 'id'  => 2, 'name' => 'contribuyente', 'last_name' => 'base' ]);

        $this->insert('role',  [ 'id'  => 1, 'type' => 'Administrador' ]);
        $this->insert('role',  [ 'id'  => 2, 'type' => 'Contribuyente' ]);

        $this->insert('user',  [ 'id'  => 1, 'username' => 'admin', 'password_hash' => '$2y$10$HTR60gXWuY9z93MPWz1jwu58Oqfys2pu3uxl6IiRvjYPUxpLzYFIu', 'password_reset_token' => Null, 'access_token' => 'ewrg(//(/FGtygvTCFR%&45fg6h7tm6tg65dr%RT&H/(O_O', 'created_at' => NULL, 'updated_at' => NULL, 'status' => 1, 'role_id' => 1, 'profile_id' => 1 ]);
        $this->insert('user',  [ 'id'  => 2, 'username' => 'contrib', 'password_hash' => '$2y$10$HTR60gXWuY9z93MPWz1jwu58Oqfys2pu3uxl6IiRvjYPUxpLzYFIu', 'password_reset_token' => Null, 'access_token' => 'ewrg(//(/FGtygvTCFR%&45fg6h7tm6tg65dr%RT&H/(O_O', 'created_at' => NULL, 'updated_at' => NULL, 'status' => 1, 'role_id' => 2, 'profile_id' => 2 ]);

        //Registro de servicios publicos
        $this->insert('public_service',
            [   
                'id'          => 1,
                'name'        => 'cnt_agregar_precio', 
                'description' => 'Función Publica de Agregado de Precios',
                'controller'  => 'ContactMessageController',
                'action'      => '*',
                'method'      => '*'
            ]);
        $this->insert('public_service_couta_meter',
            [ 
                'id'                 => 1,
                'cod'                => 'cnt_agregar_precio-max_inp', 
                'description'        => 'Limite uso 50 por hora',
                'time_lapse_seconds' => 3600,
                'amount'             => 50
            ]);

        $this->insert('public_service_couta',
            [ 
                'id_cuota_meter'    => 1, 
                'id_public_service' => 1
            ]);

        $this->insert('public_service',
            [   
                'id'          => 2,
                'name'        => 'all_vendors', 
                'description' => 'Marcas',
                'controller'  => 'PublicVendorController',
                'action'      => '*',
                'method'      => '*'
            ]);
        $this->insert('public_service_couta_meter',
            [ 
                'id'                 => 2,
                'cod'                => 'all_services-ilimitado', 
                'description'        => 'Sin limite de consulta',
                'time_lapse_seconds' => -1,
                'amount'             => -1
            ]);

        $this->insert('public_service_couta',
            [ 
                'id'                => 2,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 2
            ]);

        $this->insert('public_service',
            [   
                'id'          => 3,
                'name'        => 'all_products', 
                'description' => 'Productos',
                'controller'  => 'PublicProductsController',
                'action'      => '*',
                'method'      => '*'
            ]);

        $this->insert('public_service_couta',
            [ 
                'id'                => 3,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 3
            ]);

        $this->insert('public_service',
            [   
                'id'          => 4,
                'name'        => 'all_prices', 
                'description' => 'Precios',
                'controller'  => 'PublicPriceController',
                'action'      => '*',
                'method'      => '*'
            ]);

        $this->insert('public_service_couta',
            [ 
                'id'                => 4,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 4
            ]);

        $this->insert('public_service',
            [   
                'id'          => 5,
                'name'        => 'all_enterprices', 
                'description' => 'Comercios',
                'controller'  => 'PublicEnterpriceController',
                'action'      => '*',
                'method'      => '*'
            ]);

        $this->insert('public_service_couta',
            [ 
                'id'                => 5,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 5
            ]);

        $this->insert('public_service',
            [   
                'id'          => 6,
                'name'        => 'all_categories', 
                'description' => 'Categorias Productos',
                'controller'  => 'PublicCategoryController',
                'action'      => '*',
                'method'      => '*'
            ]);

        $this->insert('public_service_couta',
            [ 
                'id'                => 6,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 6
            ]);

        $this->insert('public_service',
            [   
                'id'          => 7,
                'name'        => 'all_branchs', 
                'description' => 'Sucursales',
                'controller'  => 'PublicBranchController',
                'action'      => '*',
                'method'      => '*'
            ]);

        $this->insert('public_service_couta',
            [ 
                'id'                => 7,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 7
            ]);

        $this->insert('public_service',
            [   
                'id'          => 8,
                'name'        => 'all_product_category', 
                'description' => 'Categorias productos',
                'controller'  => 'PublicProductCategoryController',
                'action'      => '*',
                'method'      => '*'
            ]);

        $this->insert('public_service_couta',
            [ 
                'id'                => 8,
                'id_cuota_meter'    => 2, 
                'id_public_service' => 8
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220108_020220_autentication_tables cannot be reverted.\n";

        return false;
    }
}
