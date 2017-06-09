<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_items`.
 */
class m170601_064002_create_order_items_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'name' => $this->string(),
            'price' => $this->float(),
            'qty_item' => $this->integer(),
            'sum_item' => $this->float(),
        ]);

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

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_items');
    }
}
