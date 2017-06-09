<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170522_111236_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'password' => $this->string(),
            'is_admin' => $this->integer()->defaultValue(0),
            'photo' => $this->string(),
            'vk_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
