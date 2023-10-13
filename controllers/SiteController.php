<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RegIngredient;
use app\models\Receita;
use app\models\Ingrediente;
use app\models\ReceitaIngrediente;
use app\controllers\ReceitaController;
class SiteController extends Controller
{




    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
    $receitas = Receita::find()->all();
    $quantidadeSuficientes = 0;
        foreach ($receitas as $receita) {
            $ingredientes = $receita->ingredientes;
            $ingredientesSuficientes = true;

            foreach ($ingredientes as $ingrediente) {
                if ($ingrediente->quantidade < $receita->getQuantidadeParaIngrediente($ingrediente->id)) {
                    $ingredientesSuficientes = false;
                    break;
                }
            }

            if ($ingredientesSuficientes) {
                $quantidadeSuficientes +=1;
            }
        }
        $quantidadeReceitas = Receita::find()->count();
        $quantidadeIngredientes = Ingrediente::find()->count();

        return $this->render('index', [
            'quantidadeReceitas' => $quantidadeReceitas,
            'quantidadeIngredientes' => $quantidadeIngredientes,
            'quantidadeDisponiveis' => $quantidadeSuficientes,
        ]);
    }
}
