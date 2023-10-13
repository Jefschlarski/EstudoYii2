<?php

use app\models\ReceitaIngrediente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Receita Ingredientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receita-ingrediente-index">
<div class="header"><h1><?= Html::encode($this->title) ?></h1></div>
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => 'Não há ingredientes vinculados para exibir.',
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'headerRowOptions' => ['class' => 'thead-dark'],
        'summary' => Yii::t('app', 'Total {totalCount} items'),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'receita_id',
                'enableSorting' => false,
                'contentOptions' => ['style' => 'color: black;'], 
                'value' => function($model) {
                    return $model->receita->nome; 
                },
                'header' => 'Nome da Receita'
            ],
            [
                'attribute' => 'ingrediente_id',
                'enableSorting' => false,
                'contentOptions' => ['style' => 'color: black;'], 
                'value' => function($model) {
                    return $model->ingrediente->nome; 
                },
                'header' => 'Nome do Ingrediente'
            ],
            [
                'attribute' => 'quantidade',
                'enableSorting' => false,
                'contentOptions' => ['style' => 'color: black;'], 
            ],
        ],
    ]); ?>


</div>

<style>
    .header{
        padding:2em;
    }
</style>