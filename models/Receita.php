<?php

namespace app\models;

use Yii;
use app\models\Ingrediente;

/**
 * This is the model class for table "recipe".
 *
 * @property int $id
 * @property string $name
 */
class Receita extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receita';
    }

    /**
     * {@inheritdoc}
     */
    public function getIngredientes()
    {
        return $this->hasMany(Ingrediente::class, ['id' => 'ingrediente_id'])
            ->viaTable('receita_ingrediente', ['receita_id' => 'id']);
    }

    public function getQuantidadeParaIngrediente($ingredienteId)
    {
        $receitaIngrediente = ReceitaIngrediente::findOne(['receita_id' => $this->id, 'ingrediente_id' => $ingredienteId]);

        return $receitaIngrediente ? $receitaIngrediente->quantidade : 0;
    }
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 255],
            [['nome'], 'unique', 'targetClass' => Receita::class, 'targetAttribute' => 'nome', 'message' => 'Esta receita já existe.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'nome' => Yii::t('app', 'Nome da Receita'),
        ];
    }
    public function getReceitaIngredientes()
    {
        return $this->hasMany(ReceitaIngrediente::className(), ['receita_id' => 'id']);
    }
}
