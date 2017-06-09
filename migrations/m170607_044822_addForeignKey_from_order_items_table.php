<?php

use yii\db\Migration;

class m170607_044822_addForeignKey_from_order_items_table extends Migration
{
    public function up()
    {
        //creates index for column `order_id`
        $this->createIndex(
            'idx-post-order_id',
            'order_items',
            'order_id'
        );

        //add foreign key for table `order`
        $this->addForeignKey(
            'fk-post-order_id',
            'order_items',
            'order_id',
            'order',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m170607_044822_addForeignKey_from_order_items_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
