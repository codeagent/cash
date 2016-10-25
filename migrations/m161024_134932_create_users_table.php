<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `users`.
 */
class m161024_134932_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => Schema::TYPE_STRING . ' NOT NULL',
            'access_token' =>  Schema::TYPE_STRING . ' NULL',
            'password_hash'=> Schema::TYPE_STRING . ' NOT NULL',
            'balance' => Schema::TYPE_DECIMAL . '(10,2) NOT NULL DEFAULT 0.00',
            'is_admin' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
