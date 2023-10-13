<?php

use yii\db\Migration;

/**
 * Class m231003_162721_add_table_receita_ingrediente
 */
class m231003_162721_add_table_receita_ingrediente extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'PRAGMA foreign_keys = ON;';
        $this->execute($sql);

        $tableOptions = null;
        $this->createTable('receita_ingrediente', [
            'receita_id' => $this->integer()->notNull(),
            'ingrediente_id' => $this->integer()->notNull(),
            'quantidade' => $this->integer()->notNull(),
            'FOREIGN KEY (receita_id) REFERENCES receita(id)',
            'FOREIGN KEY (ingrediente_id) REFERENCES ingrediente(id)',
            'PRIMARY KEY (receita_id, ingrediente_id)',
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('receita_ingrediente');
    }
}
