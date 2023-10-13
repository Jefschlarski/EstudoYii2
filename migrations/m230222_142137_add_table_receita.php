<?php

use yii\db\Migration;

/**
 * Class m230222_142137_add_table_receita
 */
class m230222_142137_add_table_receita extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $this->createTable('receita', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('receita');
        $this->update('sqlite_sequence', ['seq' => 0], ['name' => 'receita']);
    }
}
