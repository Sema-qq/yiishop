<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170522_111226_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'category_id' => $this->integer(),
            'code' => $this->integer(),
            'price' => $this->float(),
            'availability' => $this->string(),
            'brand' => $this->string(),
            'image' => $this->string(),
            'description' => $this->text(),
            'is_new' => $this->string(),
            'is_recommended' => $this->string(),
            'status' => $this->string()->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
