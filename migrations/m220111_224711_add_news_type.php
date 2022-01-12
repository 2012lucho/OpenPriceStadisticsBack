<?php

use yii\db\Migration;

/**
 * Class m220111_224711_add_news_type
 */
class m220111_224711_add_news_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220111_224711_add_news_type cannot be reverted.\n";

        return false;
    }

}
