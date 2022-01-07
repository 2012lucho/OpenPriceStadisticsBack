<?php

use yii\db\Migration;

/**
 * Class m220107_195735_initial_data_1
 */
class m220107_195735_initial_data_1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Inserts Branch
        $this->insert('branch',  [ 'id' => 1,'name' => 'Monarca Online',
            'latitude' => 0, 'longitude' => 0, 'address_road' => '0', 
            'address_number'  => '0', 'enterprise_id'   => 1 ]);

        $this->insert('branch',  [ 'id' => 2,'name' => 'Asia Online',
            'latitude' => 0, 'longitude' => 0, 'address_road' => '0', 
            'address_number'  => '0', 'enterprise_id'   => 2 ]);

        $this->insert('branch',  [ 'id' => 3,'name' => 'Asia - España 502 - Tandil',
            'latitude' => 0, 'longitude' => 0, 'address_road' => 'Av. España', 
            'address_number'  => '502', 'enterprise_id'   => 2 ]);

        $this->insert('branch',  [ 'id' => 4,'name' => 'Soychú Tandil',
            'latitude' => 0, 'longitude' => 0, 'address_road' => '-', 
            'address_number'  => '-', 'enterprise_id'   => 3 ]);

        $this->insert('branch',  [ 'id' => 5,'name' => 'Carnicerías Tandil',
            'latitude' => 0, 'longitude' => 0, 'address_road' => 'Río de janeiro', 
            'address_number'  => '619', 'enterprise_id'   => 4 ]);

        $this->insert('branch',  [ 'id' => 6,'name' => 'Punto Carne Tandil',
            'latitude' => 0, 'longitude' => 0, 'address_road' => '-', 
            'address_number'  => '-', 'enterprise_id'   => 5 ]);

        //Inserts Category
        $this->insert('category',  [ 'id' => 1,'root_category_id' => NULL,'name' => 'Galletita']);
        $this->insert('category',  [ 'id' => 2,'root_category_id' => 1,'name' => 'Boca de dama']);
        $this->insert('category',  [ 'id' => 3,'root_category_id' => 1,'name' => 'Galletitas surtidas']);
        $this->insert('category',  [ 'id' => 4,'root_category_id' => 1,'name' => 'Galletitas \"tipo criollitas\"']);
        $this->insert('category',  [ 'id' => 5,'root_category_id' => 1,'name' => 'Galletitas rellenas']);
        $this->insert('category',  [ 'id' => 6,'root_category_id' => NULL,'name' => 'Mermelada']);
        $this->insert('category',  [ 'id' => 7,'root_category_id' => 6,'name' => 'Mermelada Damasco']);
        $this->insert('category',  [ 'id' => 8,'root_category_id' => NULL,'name' => 'Café']);
        $this->insert('category',  [ 'id' => 9,'root_category_id' => 8,'name' => 'Café Soluble']);
        $this->insert('category',  [ 'id' => 10,'root_category_id' => NULL,'name' => 'Frutas']);
        $this->insert('category',  [ 'id' => 11,'root_category_id' => NULL,'name' => 'Carne']);
        $this->insert('category',  [ 'id' => 12,'root_category_id' => 11,'name' => 'Cerdo']);
        $this->insert('category',  [ 'id' => 13,'root_category_id' => NULL,'name' => 'Fideo']);
        $this->insert('category',  [ 'id' => 14,'root_category_id' => 13,'name' => 'Mostachol']);
        $this->insert('category',  [ 'id' => 15,'root_category_id' => NULL,'name' => 'Antitranspirante']);
        $this->insert('category',  [ 'id' => 16,'root_category_id' => 15,'name' => 'Antitranspirante en Aerosol']);
        $this->insert('category',  [ 'id' => 17,'root_category_id' => NULL,'name' => 'Yerba']);
        $this->insert('category',  [ 'id' => 18,'root_category_id' => 27,'name' => 'Shampoo']);
        $this->insert('category',  [ 'id' => 19,'root_category_id' => NULL,'name' => 'Suavizante']);
        $this->insert('category',  [ 'id' => 20,'root_category_id' =>  13,'name' => 'Fideo Moño']);
        $this->insert('category',  [ 'id' => 21,'root_category_id' => NULL,'name' => 'Tomate en Lata']);
        $this->insert('category',  [ 'id' => 22,'root_category_id' =>  NULL,'name' => 'Productos de Limpieza']);
        $this->insert('category',  [ 'id' => 23,'root_category_id' => 22,'name' => 'Lavandina']);
        $this->insert('category',  [ 'id' => 24,'root_category_id' => 23,'name' => 'Lavandina en Gel']);
        $this->insert('category',  [ 'id' => 25,'root_category_id' =>  NULL,'name' => 'Atun']);
        $this->insert('category',  [ 'id' => 26,'root_category_id' => 25,'name' => 'Atún Desmenuzado al Natural']);
        $this->insert('category',  [ 'id' => 27,'root_category_id' => NULL,'name' => 'Aseo Personal']);
        $this->insert('category',  [ 'id' => 28,'root_category_id' => 27,'name' => 'Pasta Dental']);
        $this->insert('category',  [ 'id' => 29,'root_category_id' =>  NULL,'name' => 'Arroz']);
        $this->insert('category',  [ 'id' => 30,'root_category_id' => NULL,'name' => 'Aceite']);
        $this->insert('category',  [ 'id' => 31,'root_category_id' => 30,'name' => 'Aceite Girasol']);
        $this->insert('category',  [ 'id' => 32,'root_category_id' => NULL,'name' => 'Caldo']);
        $this->insert('category',  [ 'id' => 33,'root_category_id' => 32,'name' => 'Caldo de Gallina']);
        $this->insert('category',  [ 'id' => 34,'root_category_id' => NULL,'name' => 'Jabón Líquido']);
        $this->insert('category',  [ 'id' => 35,'root_category_id' => 1,'name' => 'Galletita c Chips']);
        $this->insert('category',  [ 'id' => 36,'root_category_id' => NULL,'name' => 'Mayonesa']);
        $this->insert('category',  [ 'id' => 37,'root_category_id' => NULL,'name' => 'Cacao']);
        $this->insert('category',  [ 'id' => 38,'root_category_id' => NULL,'name' => 'Milanesa']);
        $this->insert('category',  [ 'id' => 39,'root_category_id' => 38,'name' => 'Milanesa de Pollo']);
        $this->insert('category',  [ 'id' => 45,'root_category_id' => 11,'name' => 'Carne de Vaca']);
        $this->insert('category',  [ 'id' => 46,'root_category_id' => 45,'name' => 'Asado de Ternera']);
        $this->insert('category',  [ 'id' => 47,'root_category_id' => 45,'name' => 'Tapa de asado']);
        $this->insert('category',  [ 'id' => 48,'root_category_id' => NULL,'name' => 'Bebidas']);
        $this->insert('category',  [ 'id' => 49,'root_category_id' => 48,'name' => 'Bebidas con Alcohol']);
        $this->insert('category',  [ 'id' => 50,'root_category_id' => 49,'name' => 'Vino']);
        $this->insert('category',  [ 'id' => 51,'root_category_id' => 50,'name' => 'Vino Tinto']);
        $this->insert('category',  [ 'id' => 52,'root_category_id' => 51,'name' => 'Vino Malbec']);
        $this->insert('category',  [ 'id' => 53,'root_category_id' => 49,'name' => 'Cerveza']);
        $this->insert('category',  [ 'id' => 54,'root_category_id' => 53,'name' => 'Cerveza Rubia']);
        $this->insert('category',  [ 'id' => 55,'root_category_id' => NULL,'name' => 'Lácteo']);
        $this->insert('category',  [ 'id' => 56,'root_category_id' =>  55,'name' => 'Yogur']);
        $this->insert('category',  [ 'id' => 57,'root_category_id' => 56,'name' => 'Yogur Bebible']);
        $this->insert('category',  [ 'id' => 58,'root_category_id' => 57,'name' => 'Yogur Bebible Vainilla']);
        $this->insert('category',  [ 'id' => 59,'root_category_id' =>  55,'name' => 'Leche']);
        $this->insert('category',  [ 'id' => 60,'root_category_id' => 59,'name' => 'Leche Chocolatada']);
        $this->insert('category',  [ 'id' => 61,'root_category_id' => 45,'name' => 'Vacío']);
        $this->insert('category',  [ 'id' => 62,'root_category_id' => 45,'name' => 'Asado Americano']);
        $this->insert('category',  [ 'id' => 63,'root_category_id' => 45,'name' => 'Falda Parrillera']);

        //Inserts enterprice
        $this->insert('enterprice',  [ 'id' => 1, 'name' => 'Supermercados Monarca']);
        $this->insert('enterprice',  [ 'id' => 2, 'name' => 'Supermercados Asia']);
        $this->insert('enterprice',  [ 'id' => 3, 'name' => 'Soychú Tandil']);
        $this->insert('enterprice',  [ 'id' => 4, 'name' => 'Carnicerías Tandil']);
        $this->insert('enterprice',  [ 'id' => 5, 'name' => 'Punto Carne Tandil']);

        //inserts price
        $this->insert('price',  ['id' => 6,  'product_id' => 1, 'price' => 90, 'date_time' => '2021-07-16 16:43:29', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 7,  'product_id' => 2, 'price' => 140, 'date_time' => '2021-07-16 16:45:20', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 8,  'product_id' => 3, 'price' => 109.3, 'date_time' => '2021-07-16 16:52:00', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 9,  'product_id' => 5, 'price' => 150, 'date_time' => '2021-07-14 17:00:19', 'user_id' => NULL, 'branch_id' => 2, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 10, 'product_id' => 6, 'price' => 90, 'date_time' => '2021-07-14 17:03:34', 'user_id' => NULL, 'branch_id' => 2, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 11, 'product_id' => 7, 'price' => 290, 'date_time' => '2021-07-05 17:09:35', 'user_id' => NULL, 'branch_id' => 2, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 12, 'product_id' => 8, 'price' => 70, 'date_time' => '2021-06-14 17:13:04', 'user_id' => NULL, 'branch_id' => 2, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 13, 'product_id' => 9, 'price' => 75, 'date_time' => '2021-07-08 20:06:22', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 14, 'product_id' => 10, 'price' => 300, 'date_time' => '2021-07-08 20:08:31', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 15, 'product_id' => 11, 'price' => 190, 'date_time' => '2021-07-08 20:12:39', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 16, 'product_id' => 12, 'price' => 400, 'date_time' => '2021-07-08 20:14:35', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 17, 'product_id' => 13, 'price' => 440, 'date_time' => '2021-07-08 20:18:11', 'user_id' => NULL, 'branch_id' => 2, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 18, 'product_id' => 14, 'price' => 125, 'date_time' => '2021-07-08 20:20:43', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 19, 'product_id' => 15, 'price' => 110, 'date_time' => '2021-07-08 20:27:04', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 20, 'product_id' => 16, 'price' => 95, 'date_time' => '2021-07-08 20:30:27', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 21, 'product_id' => 17, 'price' => 270, 'date_time' => '2021-07-08 20:35:51', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 22, 'product_id' => 18, 'price' => 100, 'date_time' => '2021-07-08 20:38:26', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 23, 'product_id' => 19, 'price' => 205, 'date_time' => '2021-07-08 20:41:34', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 24, 'product_id' => 20, 'price' => 180, 'date_time' => '2021-07-08 20:43:43', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 25, 'product_id' => 21, 'price' => 200, 'date_time' => '2021-07-08 20:46:44', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 26, 'product_id' => 22, 'price' => 365, 'date_time' => '2021-07-08 20:49:14', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 27, 'product_id' => 23, 'price' => 109, 'date_time' => '2021-07-08 20:51:34', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 28, 'product_id' => 24, 'price' => 600, 'date_time' => '2021-07-12 20:56:36', 'user_id' => NULL, 'branch_id' => 2, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 29, 'product_id' => 25, 'price' => 650, 'date_time' => '2021-07-12 20:58:58', 'user_id' => NULL, 'branch_id' => 2, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 30, 'product_id' => 26, 'price' => 80, 'date_time' => '2021-07-12 21:02:41', 'user_id' => NULL, 'branch_id' => 3, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 31, 'product_id' => 27, 'price' => 180, 'date_time' => '2021-07-11 21:05:01', 'user_id' => NULL, 'branch_id' => 3, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 32, 'product_id' => 28, 'price' => 130, 'date_time' => '2021-07-05 21:10:05', 'user_id' => NULL, 'branch_id' => 3, 'es_oferta' => 1, 'porcentage_oferta' => 13]);
        $this->insert('price',  ['id' => 33, 'product_id' => 29, 'price' => 50, 'date_time' => '2021-07-05 21:12:23', 'user_id' => NULL, 'branch_id' => 3, 'es_oferta' => 1, 'porcentage_oferta' => 50]);
        $this->insert('price',  ['id' => 34, 'product_id' => 30, 'price' => 200, 'date_time' => '2021-12-02 21:17:26', 'user_id' => NULL, 'branch_id' => 4, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 35, 'product_id' => 31, 'price' => 500, 'date_time' => '2021-07-07 21:24:43', 'user_id' => NULL, 'branch_id' => 5, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 36, 'product_id' => 32, 'price' => 650, 'date_time' => '2021-07-07 21:26:43', 'user_id' => NULL, 'branch_id' => 5, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 37, 'product_id' => 33, 'price' => 160.65, 'date_time' => '2021-07-28 15:00:52', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 1, 'porcentage_oferta' => 15]);
        $this->insert('price',  ['id' => 38, 'product_id' => 34, 'price' => 174.25, 'date_time' => '2021-07-28 15:03:26', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 1, 'porcentage_oferta' => 15]);
        $this->insert('price',  ['id' => 39, 'product_id' => 35, 'price' => 110.5, 'date_time' => '2021-07-28 15:06:08', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 1, 'porcentage_oferta' => 15]);
        $this->insert('price',  ['id' => 40, 'product_id' => 36, 'price' => 89.25, 'date_time' => '2021-07-28 15:07:50', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 1, 'porcentage_oferta' => 15]);
        $this->insert('price',  ['id' => 41, 'product_id' => 37, 'price' => 174.25, 'date_time' => '2021-07-28 15:09:34', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 1, 'porcentage_oferta' => 15]);
        $this->insert('price',  ['id' => 42, 'product_id' => 38, 'price' => 113.6, 'date_time' => '2021-07-26 15:16:43', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 1, 'porcentage_oferta' => 20]);
        $this->insert('price',  ['id' => 43, 'product_id' => 39, 'price' => 225, 'date_time' => '2021-07-26 15:21:25', 'user_id' => NULL, 'branch_id' => 1, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 44, 'product_id' => 40, 'price' => 570, 'date_time' => '2021-07-24 15:27:52', 'user_id' => NULL, 'branch_id' => 6, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 45, 'product_id' => 41, 'price' => 550, 'date_time' => '2021-07-21 15:30:39', 'user_id' => NULL, 'branch_id' => 6, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
        $this->insert('price',  ['id' => 46, 'product_id' => 42, 'price' => 300, 'date_time' => '2021-07-17 15:32:51', 'user_id' => NULL, 'branch_id' => 6, 'es_oferta' => 0, 'porcentage_oferta' => NULL]);
    
        //products
        $this->insert('products',  [ 'id' => 1, 'name' => 'Galletita Terrabusi Boca de Dama - 160Gr', 'vendor_id' =>  1]);
        $this->insert('products',  [ 'id' => 2, 'name' => 'Galletita Terrabusi Surtidas - 400 Gr', 'vendor_id' =>  1]);
        $this->insert('products',  [ 'id' => 3, 'name' => 'Galletitas Express Clasicas - x3 - 324Gr', 'vendor_id' =>  2]);
        $this->insert('products',  [ 'id' => 4, 'name' => 'Galletitas Oreo - 117Gr', 'vendor_id' =>  3]);
        $this->insert('products',  [ 'id' => 5, 'name' => 'Mermelada de Damasco - 360Gr', 'vendor_id' =>  5]);
        $this->insert('products',  [ 'id' => 6, 'name' => 'Galletitas Chocolinas - 170 Gr', 'vendor_id' =>  7]);
        $this->insert('products',  [ 'id' => 7, 'name' => 'Café Soluble Dolca Suave - 170Gr', 'vendor_id' =>  9]);
        $this->insert('products',  [ 'id' => 8, 'name' => 'Tomate', 'vendor_id' =>  10]);
        $this->insert('products',  [ 'id' => 9, 'name' => 'Fideos Mostachol Knorr- 500Gr', 'vendor_id' =>  11]);
        $this->insert('products',  [ 'id' => 10, 'name' => 'Café Arlistán - 170Gr', 'vendor_id' =>  12]);
        $this->insert('products',  [ 'id' => 11, 'name' => 'Antitranspirante Dove - Hombre - Aerosol - 150Ml', 'vendor_id' =>  13]);
        $this->insert('products',  [ 'id' => 12, 'name' => 'Yerba Mate - Nobleza Gaucha - Suave - 500Gr', 'vendor_id' =>  14]);
        $this->insert('products',  [ 'id' => 13, 'name' => 'Shampoo - Tresemmé - Hidratación Profunda - 750 Ml', 'vendor_id' =>  15]);
        $this->insert('products',  [ 'id' => 14, 'name' => 'Suavizante - Vivere - 900Ml', 'vendor_id' =>  16]);
        $this->insert('products',  [ 'id' => 15, 'name' => 'Fideos Moño - Matarazzo - 500Gr', 'vendor_id' =>  17]);
        $this->insert('products',  [ 'id' => 16, 'name' => 'Tomate Perita en Lata - INCA - 400Gr', 'vendor_id' =>  18]);
        $this->insert('products',  [ 'id' => 17, 'name' => 'Lavandina en Gel - Ayudín - 1,5L', 'vendor_id' =>  19]);
        $this->insert('products',  [ 'id' => 18, 'name' => 'Atún Desmenuzado al Natural - Caracas - 170Gr', 'vendor_id' =>  20]);
        $this->insert('products',  [ 'id' => 19, 'name' => 'Pasta Dental - Colgate Sensitive Blanqueadora - 100Gr', 'vendor_id' =>  21]);
        $this->insert('products',  [ 'id' => 20, 'name' => 'Arroz Gallo - Largo Fino - 1Kg', 'vendor_id' =>  22]);
        $this->insert('products',  [ 'id' => 21, 'name' => 'Aceite Lira - Girasol - 900Ml', 'vendor_id' =>  23]);
        $this->insert('products',  [ 'id' => 22, 'name' => 'Shampoo Sedal - Restauración Instantánea - 650 Ml', 'vendor_id' =>  24]);
        $this->insert('products',  [ 'id' => 23, 'name' => 'Caldo de Gallina - Knorr - 12u', 'vendor_id' =>  11]);
        $this->insert('products',  [ 'id' => 24, 'name' => 'Jabón Líquido - Ala - 3L', 'vendor_id' =>  25]);
        $this->insert('products',  [ 'id' => 25, 'name' => 'Jabón Líquido - Skip - 3L', 'vendor_id' =>  26]);
        $this->insert('products',  [ 'id' => 26, 'name' => 'Arroz - Yatay - 1Kg', 'vendor_id' =>  27]);
        $this->insert('products',  [ 'id' => 27, 'name' => 'Galletitas Pepitos - 3 unidades - 357Gr', 'vendor_id' =>  28]);
        $this->insert('products',  [ 'id' => 28, 'name' => 'Mayonesa - Hellmann\'s - 475Gr', 'vendor_id' =>  29]);
        $this->insert('products',  [ 'id' => 29, 'name' => 'Cacao Arcor - 180Gr', 'vendor_id' =>  30]);
        $this->insert('products',  [ 'id' => 30, 'name' => 'Milanesa de Pollo - Soychú - 1Kg', 'vendor_id' =>  31]);
        $this->insert('products',  [ 'id' => 31, 'name' => 'Asado de ternera - 1Kg', 'vendor_id' =>  10]);
        $this->insert('products',  [ 'id' => 32, 'name' => 'Tapa de asado - 1Kg', 'vendor_id' =>  10]);
        $this->insert('products',  [ 'id' => 33, 'name' => 'Vino Novecento - Malbec - 750cc', 'vendor_id' =>  32]);
        $this->insert('products',  [ 'id' => 34, 'name' => 'Cerveza Patagonia - 730Ml', 'vendor_id' =>  33]);
        $this->insert('products',  [ 'id' => 35, 'name' => 'Cerveza Rubia - Budweiser - 750Ml', 'vendor_id' =>  34]);
        $this->insert('products',  [ 'id' => 36, 'name' => 'Cerveza Rubia - Andes - 473Ml', 'vendor_id' =>  35]);
        $this->insert('products',  [ 'id' => 37, 'name' => 'Cerveza Rubia - Corona - 710Ml', 'vendor_id' =>  36]);
        $this->insert('products',  [ 'id' => 38, 'name' => 'Yogur Bebible - La Serenísima - Vainilla - 1L', 'vendor_id' =>  37]);
        $this->insert('products',  [ 'id' => 39, 'name' => 'Leche Chocolatada - Cindor - 1L', 'vendor_id' =>  38]);
        $this->insert('products',  [ 'id' => 40, 'name' => 'Vacío', 'vendor_id' =>  10]);
        $this->insert('products',  [ 'id' => 41, 'name' => 'Asado Americano', 'vendor_id' =>  10]);
        $this->insert('products',  [ 'id' => 42, 'name' => 'Falda Parrillera', 'vendor_id' =>  10]);

        //product category
        $this->insert('product_category',  [ 'id' => 1, 'product_id' => 1, 'category_id' => 2]);
        $this->insert('product_category',  [ 'id' => 2, 'product_id' => 2, 'category_id' => 3]);
        $this->insert('product_category',  [ 'id' => 3, 'product_id' => 3, 'category_id' => 4]);
        $this->insert('product_category',  [ 'id' => 4, 'product_id' => 4, 'category_id' => 5]);
        $this->insert('product_category',  [ 'id' => 5, 'product_id' => 5, 'category_id' => 7]);
        $this->insert('product_category',  [ 'id' => 6, 'product_id' => 6, 'category_id' => 1]);
        $this->insert('product_category',  [ 'id' => 7, 'product_id' => 7, 'category_id' => 9]);
        $this->insert('product_category',  [ 'id' => 8, 'product_id' => 8, 'category_id' => 10]);
        $this->insert('product_category',  [ 'id' => 9, 'product_id' => 9, 'category_id' => 14]);
        $this->insert('product_category',  [ 'id' => 10, 'product_id' => 10, 'category_id' => 9]);
        $this->insert('product_category',  [ 'id' => 11, 'product_id' => 11, 'category_id' => 16]);
        $this->insert('product_category',  [ 'id' => 12, 'product_id' => 12, 'category_id' => 17]);
        $this->insert('product_category',  [ 'id' => 13, 'product_id' => 13, 'category_id' => 18]);
        $this->insert('product_category',  [ 'id' => 14, 'product_id' => 14, 'category_id' => 19]);
        $this->insert('product_category',  [ 'id' => 15, 'product_id' => 15, 'category_id' => 20]);
        $this->insert('product_category',  [ 'id' => 16, 'product_id' => 16, 'category_id' => 21]);
        $this->insert('product_category',  [ 'id' => 17, 'product_id' => 17, 'category_id' => 24]);
        $this->insert('product_category',  [ 'id' => 18, 'product_id' => 18, 'category_id' => 26]);
        $this->insert('product_category',  [ 'id' => 19, 'product_id' => 19, 'category_id' => 28]);
        $this->insert('product_category',  [ 'id' => 20, 'product_id' => 20, 'category_id' => 29]);
        $this->insert('product_category',  [ 'id' => 21, 'product_id' => 21, 'category_id' => 31]);
        $this->insert('product_category',  [ 'id' => 22, 'product_id' => 22, 'category_id' => 18]);
        $this->insert('product_category',  [ 'id' => 23, 'product_id' => 23, 'category_id' => 33]);
        $this->insert('product_category',  [ 'id' => 24, 'product_id' => 24, 'category_id' => 34]);
        $this->insert('product_category',  [ 'id' => 25, 'product_id' => 25, 'category_id' => 34]);
        $this->insert('product_category',  [ 'id' => 26, 'product_id' => 27, 'category_id' => 35]);
        $this->insert('product_category',  [ 'id' => 27, 'product_id' => 28, 'category_id' => 36]);
        $this->insert('product_category',  [ 'id' => 28, 'product_id' => 29, 'category_id' => 37]);
        $this->insert('product_category',  [ 'id' => 29, 'product_id' => 30, 'category_id' => 39]);
        $this->insert('product_category',  [ 'id' => 30, 'product_id' => 31, 'category_id' => 46]);
        $this->insert('product_category',  [ 'id' => 31, 'product_id' => 32, 'category_id' => 47]);
        $this->insert('product_category',  [ 'id' => 32, 'product_id' => 33, 'category_id' => 52]);
        $this->insert('product_category',  [ 'id' => 33, 'product_id' => 34, 'category_id' => 53]);
        $this->insert('product_category',  [ 'id' => 34, 'product_id' => 35, 'category_id' => 54]);
        $this->insert('product_category',  [ 'id' => 35, 'product_id' => 36, 'category_id' => 54]);
        $this->insert('product_category',  [ 'id' => 36, 'product_id' => 37, 'category_id' => 54]);
        $this->insert('product_category',  [ 'id' => 37, 'product_id' => 38, 'category_id' => 58]);
        $this->insert('product_category',  [ 'id' => 38, 'product_id' => 39, 'category_id' => 60]);
        $this->insert('product_category',  [ 'id' => 39, 'product_id' => 40, 'category_id' => 61]);
        $this->insert('product_category',  [ 'id' => 40, 'product_id' => 41, 'category_id' => 62]);
        $this->insert('product_category',  [ 'id' => 41, 'product_id' => 42, 'category_id' => 63]);

        //vendor
        $this->insert('vendor',  [ 'id' => 1, 'name' => 'Terrabusi', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 2, 'name' => 'Express', 'root_vendor_id' => 1]);
        $this->insert('vendor',  [ 'id' => 3, 'name' => 'Oreo', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 4, 'name' => 'La Campagnola', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 5, 'name' => 'BC', 'root_vendor_id' => 4]);
        $this->insert('vendor',  [ 'id' => 6, 'name' => 'Bagley', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 7, 'name' => 'Chocolinas', 'root_vendor_id' => 6]);
        $this->insert('vendor',  [ 'id' => 8, 'name' => 'Nescafe', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 9, 'name' => 'Dolca', 'root_vendor_id' => 8]);
        $this->insert('vendor',  [ 'id' => 10, 'name' => 'Desconocido', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 11, 'name' => 'Knorr', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 12, 'name' => 'Arlistán', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 13, 'name' => 'Dove', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 14, 'name' => 'Nobleza Gaucha', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 15, 'name' => 'Tresemmé', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 16, 'name' => 'Vivere', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 17, 'name' => 'Matarazzo', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 18, 'name' => 'INCA', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 19, 'name' => 'Ayudín', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 20, 'name' => 'Caracas', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 21, 'name' => 'Colgate', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 22, 'name' => 'Gallo', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 23, 'name' => 'Lira', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 24, 'name' => 'Sedal', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 25, 'name' => 'Ala', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 26, 'name' => 'Skip', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 27, 'name' => 'Yatay', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 28, 'name' => 'Pepitos', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 29, 'name' => 'Hellmann\'s', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 30, 'name' => 'Arcor', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 31, 'name' => 'Soychú', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 32, 'name' => 'Novecento', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 33, 'name' => 'Patagonia', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 34, 'name' => 'Budweiser', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 35, 'name' => 'Andes', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 36, 'name' => 'Corona', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 37, 'name' => 'La Serenísima', 'root_vendor_id' => NULL]);
        $this->insert('vendor',  [ 'id' => 38, 'name' => 'Cindor', 'root_vendor_id' => NULL]);
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220107_195735_initial_data_1 cannot be reverted.\n";

        return false;
    }

}
