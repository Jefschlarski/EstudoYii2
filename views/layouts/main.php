<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex container p-0 flex-column">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            // 'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-info fixed-top custom-header',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'custom-nav mx-auto'],
            'activateItems' => false,
            'items' => [
                ['label' => 'Home', 'url' => ['site/index']],
                ['label' => 'Receitas Disponiveis', 'url' => ['/receita/disponiveis']],
                ['label' => 'Receitas', 'url' => ['/receita/index']],
                ['label' => 'Ingredientes', 'url' => ['/ingrediente/index']],
                ['label' => 'Receita e Ingrediente', 'url' => ['/receita-ingrediente/index']],
            ],
        ]);
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">

            <?= $content ?>
        </div>
    </main>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>


<style>
    .custom-nav a {
        font-weight: bold;
        font-size: 20px;
        color: white;
        display: flex;
    }

    .custom-nav a:hover {

        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        
    }

    #alert{
        position: absolute;
        border-radius: 5px;
        padding:15px;
        right:0;
        margin:15px;
        font-weight:bold;
        font-size:20px;
        color:white;
    }

    .flash-error{
        background-color:red;
    }
    .flash-success{
        background-color:green;
    }
</style>