<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `reports`.
 */
class m161024_135014_create_reports_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('reports', [
            'id' => $this->primaryKey(),
            'user_id' => Schema::TYPE_INTEGER . " NOT NULL",
            'amount' => Schema::TYPE_DECIMAL . " NOT NULL",
            'article' => Schema::TYPE_INTEGER. " NOT NULL",
            'created_at' => Schema::TYPE_INTEGER . " NOT NULL",
            'FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('reports');
    }
}
