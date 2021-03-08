<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m210301_142454_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->date()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'updated_at' => $this->date(),
            'is_deleted' => $this->boolean()->defaultValue(false)->notNull(),
            'deleted_at' => $this->date(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
