<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_behavior}}`.
 */
class m200125_172347_create_user_behavior_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_behavior}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100)->null(),
            'wrong_password' => $this->string(100)->null(),
            'ip' => $this->string(100)->null(),
            'time_at' => $this->integer()->notNull(),
            'weight' => $this->integer()->defaultValue(1)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_behavior}}');
    }
}
