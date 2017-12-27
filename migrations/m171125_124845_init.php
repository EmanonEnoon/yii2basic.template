<?php

use yii\db\Migration;

/**
 * Handles the creation of table `model`.
 */
class m171125_124845_init extends Migration
{
    public $tables = [
        'user' => '{{%user}}',
    ];

    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
        }

        $this->createTable($this->tables['user'], [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('用户名'),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique()->comment('Email'),

            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('状态'),
            'created_at' => $this->integer()->comment('注册时间'),
            'updated_at' => $this->integer(),
        ], $tableOptions);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        foreach (array_reverse($this->tables) as $table) {
            $this->dropTable($table);
        }
    }
}
