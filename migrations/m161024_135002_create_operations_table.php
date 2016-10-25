<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `operations`.
 */
class m161024_135002_create_operations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('operations', [
            'id' => $this->primaryKey(),
            'amount' => Schema::TYPE_DECIMAL . '(10,2) NOT NULL DEFAULT 0.00',
            'is_debit' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'is_for_user' => Schema::TYPE_SMALLINT . '  NOT NULL DEFAULT 1',
            'user_id' => Schema::TYPE_INTEGER . ' NULL DEFAULT 0',
            'comment' => Schema::TYPE_TEXT . ' NULL',
            'created_at' => Schema::TYPE_INTEGER . " NOT NULL",
            'FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL ON UPDATE CASCADE',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('operations');
    }
}
