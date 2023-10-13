<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Receita;

class Ingrediente extends ActiveRecord
{


    public static function tableName()
    {
        return 'ingrediente';
    }

    // Define as regras de validação para os campos

    public function getReceitas()
    {
        return $this->hasMany(Receita::class, ['id' => 'receita_id'])
            ->viaTable('receita_ingrediente', ['ingrediente_id' => 'id']);
    }

    public function rules()
    {
        return [
            [['nome', 'quantidade'], 'required', 'message' => 'O campo {attribute} não pode estar vazio.'],
            [['nome'], 'string', 'max' => 255],
            [['nome'], 'unique', 'message' => 'Este ingrediente já existe.'],
            [['quantidade'], 'integer', 'min' => 1, 'tooSmall'=>'{attribute} deve ser maior que 0',],
        ];
    }
    public function attributeLabels()
    {
        return [
            'nome' => \Yii::t('app', 'Nome do Ingrediente'),
            'quantidade' => \Yii::t('app', 'Quantidade do Ingrediente'),
        ];
    }
}
