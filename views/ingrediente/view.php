<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Ingrediente $model */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Ingredientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php
    foreach(Yii::$app->session->getAllFlashes() as $key => $message) {
        echo '<div id="alert" class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<div class="ingrediente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Deletar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Você realmente deseja excluir esse ingrediente ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'quantidade',
        ],
    ]) ?>

</div>

<style>
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