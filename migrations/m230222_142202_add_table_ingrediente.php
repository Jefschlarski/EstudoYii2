<?php

use yii\db\Migration;

/**
 * Class m230222_142202_add_table_ingrediente
 */
class m230222_142202_add_table_ingrediente extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $this->createTable('ingrediente', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'quantidade' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ingrediente');
        $this->update('sqlite_sequence', ['seq' => 0], ['name' => 'ingrediente']);
    }
}
