<?php

namespace app\models;

use Yii;

class ReceitaIngrediente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'receita_ingrediente';
    }
    public function getIngrediente()
    {
        return $this->hasOne(Ingrediente::className(), ['id' => 'ingrediente_id']);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receita_id', 'ingrediente_id', 'quantidade'], 'required'],
            [['receita_id', 'ingrediente_id', 'quantidade'], 'integer'],
            [['receita_id', 'ingrediente_id'], 'unique', 'targetAttribute' => ['receita_id', 'ingrediente_id']],
            [['receita_id'], 'exist', 'skipOnError' => true, 'targetClass' => Receita::className(), 'targetAttribute' => ['receita_id' => 'id']],
            [['ingrediente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingrediente::className(), 'targetAttribute' => ['ingrediente_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'receita_id' => Yii::t('app', 'Receita ID'),
            'ingrediente_id' => Yii::t('app', 'Ingrediente ID'),
            'receita_Nome' => Yii::t('app', 'Receita Nome'),
            'ingrediente_Nome' => Yii::t('app', 'Ingrediente Nome'),
            'quantidade' => Yii::t('app', 'Quantidade'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceita()
    {
        return $this->hasOne(Receita::className(), ['id' => 'receita_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
}
