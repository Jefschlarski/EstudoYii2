<?php

use app\models\Receita;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Receitas Disponiveis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receita-com-ingredientes-suficientes">

<div class="header">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="receitas-container">
    <?php if (empty($receitas)) : ?>
        <div class="empty-message">
            Nenhuma Receita, atualize os ingredientes disponiveis ou crie uma nova receita.
        </div>
    <?php else : ?>
        <?php foreach ($receitas as $index => $receita) : ?>
            <a href="<?= Url::to(['receita/view', 'id' => $receita->id]) ?>" class="receita-card receita-<?= $index ?>">
                <div class="ingredientes-tabela">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <td colspan="2" class="receita-nome">
                                    <?= Html::encode($receita->nome) ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Ingrediente</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($receita->receitaIngredientes as $receitaIngrediente) : ?>
                                <tr>
                                    <td><?= $receitaIngrediente->ingrediente->nome ?></td>
                                    <td>
                                        <?= $receitaIngrediente->quantidade ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </a>
        <?php endforeach; ?>

    <?php endif; ?>
</div>

</div>

</div>

<style>
    .header {
        padding: 2em;
        text-align: center;
    }



    .receitas-container a {
        text-decoration: none;
        width: 100%;
    }



    .receitas-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .receita-card {
        flex: 1 1 calc(33.33% - 1em);
        padding: 1em;
        margin: 1em 0;
        width: auto;
        height: auto;
        text-align: center;
        cursor: pointer;
        box-sizing: border-box;
    }

    .receita-link {
        text-decoration: none;
        color: #333;
        display: block;
    }

    .ingredientes-tabela table {
        width: 100%;
        margin-top: 10px;
    }

    .ingredientes-tabela th,
    .ingredientes-tabela td {
        border: 1px solid #ccc;
        padding: 5px;
    }

    .empty-message {
        font-style: italic;
        color: #888;
    }
</style>