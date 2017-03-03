<?php

namespace app\controllers;

use Yii;
use app\models\Estoque;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstoqueController implements the CRUD actions for Estoque model.
 */
class EstoqueController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Estoque models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new \app\models\VisEstoqueSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estoque model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $model = \app\models\VisEstoqueSearch::findOne(['id' => $id]);
      
        $this->view->title = "Estoque:". $model->produto_comercial;
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new Estoque model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed

      public function actionCreate() {
      $model = new \app\models\EstoqueSearch();
      $this->view->title = "Cadastrar Estoque de Fabricação";

      $produto = \app\models\VisProdutoComercialSearch::find()->select(['produto_comercial as value', 'produto_comercial as  label', 'id as id'])->asArray()->all();

      if (Yii::$app->request->post()) {
      $model->load(Yii::$app->request->post());

      $modelExiste = \app\models\EstoqueSearch::findOne(['produto_comercial_fk' => $model->produto_comercial_fk]);

      if ($modelExiste) {

      $qtd = $model->qnt_disponivel;
      $modelExiste->qnt_disponivel = $modelExiste->qnt_disponivel + $model->qnt_disponivel;
      $model = $modelExiste;
      } else {

      $qtd = $model->qnt_disponivel;
      }

      if ($model->save()) {

      $kardex = new \app\models\Kardex();
      $modelHitorico->qnt = $qtd;
      $modelHitorico->fabricacao_fk = $model->id;
      $modelHitorico->status = '1';
      $modelHitorico->save();
      }

      return $this->redirect(['view', 'id' => $model->id]);
      } else {
      return $this->render('create', [
      'model' => $model,
      'produto' => $produto,
      ]);
      }
      } */
    /**
     * Updates an existing Estoque model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
      public function actionUpdate($id) {
      $model = $this->findModel($id);
      $qnt = $model->qnt_diponivel;

      if ($model->load(Yii::$app->request->post()) && $model->save()) {

      return $this->redirect(['view', 'id' => $model->id]);
      } else {
      return $this->render('update', [
      'model' => $model,
      ]);
      }
      }
     */
    /**
     * Deletes an existing Estoque model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed

      public function actionDelete($id) {
      $this->findModel($id)->delete();

      return $this->redirect(['index']);
      }
     */

    /**
     * Finds the Estoque model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Estoque the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Estoque::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
