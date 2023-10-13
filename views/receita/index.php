<?php

use app\models\Receita;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use Yii;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Receitas';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div id="alert" class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<div class="receita-index">
    <div class="receita-header">
        <h1><?= Html::encode($this->title) ?></h1>
        <p class="btn-custom">
            <?= Html::a('Cadastrar Receita', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyText' => 'Não há receitas para exibir.',
        'tableOptions' => ['class' => 'table table-striped table-bordered'],
        'headerRowOptions' => ['class' => 'thead-dark'],
        'summary' => Yii::t('app', 'Total {totalCount} items'),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'nome',
                'enableSorting' => false,
                'contentOptions' => ['style' => 'color: black;'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',

                'template' => '{view} {update} {delete}',
                'header' => 'Ações',
                'headerOptions' => ['style' => 'width: 250px; font-size: 18px;  text-align: center;'],
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('Visualizar', $url, ['class' => 'btn btn-info btn-sm']);
                    },
                    'update' => function ($url) {
                        return Html::a('Editar', $url, ['class' => 'btn btn-success btn-sm']);
                    },
                    'delete' => function ($url) {
                        return Html::a('Deletar', $url, [
                            'class' => 'btn btn-danger btn-sm',
                            'data-confirm' => 'Você realmente deseja excluir essa receita?',
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>

<style>
    .receita-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 2em;
    }

    .btn-custom {
        display: flex;
        justify-content: end;
        padding: 20px 0px 0px 0px
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