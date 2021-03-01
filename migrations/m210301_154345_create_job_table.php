<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job}}`.
 */
class m210301_154345_create_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('job', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'type' => $this->string(255)->notNull(),
            'requirements' => $this->string(255)->notNull(),
            'salary_range' => $this->string(128)->notNull(),
            'city' => $this->string(128)->notNull(),
            'address' => $this->string(255)->notNull(),
            'contact_email' => $this->string(255)->notNull(),
            'contact_phone' => $this->string(16)->notNull(),
            'is_published' => $this->boolean()->defaultValue(false)->notNull(),
            'created_at' => $this->date()->defaultValue(date("Y-m-d H:i:s"))->notNull(),
            'is_deleted' => $this->boolean()->defaultValue(false)->notNull(),
            'deleted_at' => $this->date(),
        ]);

        $this->addForeignKey(
            'fk-job-category_id',
            'job',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-job-user_id',
            'job',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-job-category_id',
            'job'
        );

        $this->dropForeignKey(
            'fk-job-user_id',
            'job'
        );

        $this->dropTable('job');
    }
}
