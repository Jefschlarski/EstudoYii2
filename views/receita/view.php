<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Receita $model */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Receitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php
    foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div id="alert" class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<div class="receita-view">
    <div class="view-header">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Você deseja realmente excluir essa receita?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>


    <h2>Lista de ingredientes</h2>
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $ingredientes,
            'pagination' => false,


        ]),
        'columns' => [
            [
                'attribute' => 'ingrediente.nome',
                'label' => 'Nome do Ingrediente',
            ],
            'quantidade',
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'headerRowOptions' => ['class' => 'thead-dark'],
        'summary' => Yii::t('app', 'Total {totalCount} items'),
    ]) ?>
</div>

<style>
    .view-header {
        display: flex;
        justify-content: space-between;
        padding: 2em;
    }
    #alert{
        position: absolute;
        border-radius: 5px;
        padding:10px;
        right:0;
        margin:15px;
        font-size:15px;
        color:white;
    }

    .flash-error{
        background-color:red;
    }
    .flash-success{
        background-color:green;
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var Alert = document.getElementById('alert');
            if (Alert) {
                Alert.style.display = 'none';
            }
        }, 2000); // A mensagem irá desaparecer após 5 segundos (5000 milissegundos)
    });
</script>