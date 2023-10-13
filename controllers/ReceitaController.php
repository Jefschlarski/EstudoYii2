<?php

namespace app\controllers;

use app\models\Receita;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ReceitaIngrediente;
use app\models\Ingrediente;
use yii\helpers\ArrayHelper;
use yii;
use yii\db\Expression;

/**
 * ReceitaController implements the CRUD actions for Receita model.
 */
class ReceitaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Receita models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Receita::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Receita model.
     * @param int $id Id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Obtenha os ingredientes associados e suas quantidades
        $ingredientes = ReceitaIngrediente::find()->where(['receita_id' => $id])->all();

        return $this->render('view', [
            'model' => $model,
            'ingredientes' => $ingredientes, // Passe os ingredientes para a view
        ]);
    }

    /**
     * Creates a new Receita model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $receita = new Receita();
        $ingredientesSelecionados = [];
        $quantidades = [];
        if ($receita->load(Yii::$app->request->post()) && $receita->save()) {

            $ingredientesSelecionados = Yii::$app->request->post('ingredientes');
            $quantidades = Yii::$app->request->post('quantidade');

            if (!empty($ingredientesSelecionados)) {
                foreach ($ingredientesSelecionados as $ingredienteId) {
                    $receitaIngrediente = new ReceitaIngrediente();
                    $receitaIngrediente->receita_id = $receita->id;
                    $receitaIngrediente->ingrediente_id = $ingredienteId;
                    $receitaIngrediente->quantidade = $quantidades[$ingredienteId];
                    $receitaIngrediente->save();
                }
            }

            Yii::$app->session->setFlash('success', 'Receita e ingredientes adicionados com sucesso!');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'receita' => $receita,
            'ingredientes' => Ingrediente::find()->all(),
            'ingredientesSelecionados' => $ingredientesSelecionados,
            'quantidades' => $quantidades,
        ]);
    }


    /**
     * Updates an existing Receita model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id Id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $receita = $this->findModel($id);

        if ($receita->load(Yii::$app->request->post()) && $receita->save()) {
            ReceitaIngrediente::deleteAll(['receita_id' => $id]); // Remove os antigos
            $this->saveReceitaIngredientes($receita);
            Yii::$app->session->setFlash('success', 'Receita e ingredientes atualizados com sucesso!');
            return $this->redirect(['receita/view', 'id' => $receita->id]);
        }

        $ingredientes = Ingrediente::find()->all();
        $ingredientesSelecionados = ArrayHelper::map($receita->getReceitaIngredientes()->asArray()->all(), 'ingrediente_id', 'ingrediente_id');
        $quantidades = ArrayHelper::map($receita->getReceitaIngredientes()->asArray()->all(), 'ingrediente_id', 'quantidade');

        return $this->render('update', [
            'receita' => $receita,
            'ingredientes' => $ingredientes,
            'ingredientesSelecionados' => $ingredientesSelecionados,
            'quantidades' => $quantidades,
        ]);
    }

    private function saveReceitaIngredientes($receita)
    {
        $ingredientesSelecionados = Yii::$app->request->post('ingredientes');
        $quantidades = Yii::$app->request->post('quantidade');

        if (!empty($ingredientesSelecionados)) {
            foreach ($ingredientesSelecionados as $ingredienteId) {
                $receitaIngrediente = new ReceitaIngrediente();
                $receitaIngrediente->receita_id = $receita->id;
                $receitaIngrediente->ingrediente_id = $ingredienteId;
                $receitaIngrediente->quantidade = $quantidades[$ingredienteId];
                $receitaIngrediente->save();
            }
        }
    }

    /**
     * Deletes an existing Receita model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id Id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $receita = $this->findModel($id);

        $transaction = Yii::$app->db->beginTransaction();

        try {
            // Remover da tabela de associacao (receita_ingrediente)
            ReceitaIngrediente::deleteAll(['receita_id' => $receita->id]);

            // Remover da tabela de receita
            $receita->delete();

            $transaction->commit();

            Yii::$app->session->setFlash('success', 'Receita excluída com sucesso!');
            return $this->redirect(['index']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Ocorreu um erro ao excluir a receita.');
            Yii::error($e->getMessage());
        }
    }

    public function actionReceitasComIngredientesSuficientes()
    {
        $receitas = Receita::find()->all();
        $receitasSuficientes = [];

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
                $receitasSuficientes[] = $receita;
            }
        }

        return $this->render('disponiveis', [
            'receitas' => $receitasSuficientes,
        ]);
    }

    /**
     * Finds the Receita model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id Id
     * @return Receita the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Receita::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
