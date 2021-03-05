<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210301_154339_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(128)->notNull(),
            'username' => $this->string(64)->unique()->notNull(),
            'email' => $this->string(255)->unique()->notNull(),
            'password' => $this->string(255)->notNull(),
            'auth_key' => $this->string(255)->notNull(),
            'created_at' => $this->date()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(false)->notNull(),
            'deleted_at' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
