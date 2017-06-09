<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170601_065959_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'created_id' => $this->dateTime(),
            'update_id' => $this->dateTime(),
            'qty' => $this->integer(),
            'sum' => $this->float(),
            'status' => $this->string()->defaultValue(0),
            'name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->integer(),
            'addres' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
