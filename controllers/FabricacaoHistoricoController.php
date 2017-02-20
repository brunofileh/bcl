<?php

namespace app\controllers;

use Yii;
use app\models\FabricacaoHistorico;
use app\models\FabricacaoHistoricoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FabricacaoHistoricoController implements the CRUD actions for FabricacaoHistorico model.
 */
class FabricacaoHistoricoController extends Controller {

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
     * Lists all FabricacaoHistorico models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new FabricacaoHistoricoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FabricacaoHistorico model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FabricacaoHistorico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new FabricacaoHistorico();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FabricacaoHistorico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            if ($post['FabricacaoHistoricoSearch']['qnt'] == $model->qnt) {
                $model->load($post);
                $model->save();
            } else {
                $modelHitorico = new \app\models\FabricacaoHistoricoSearch();
                $modelHitorico->load(Yii::$app->request->post());
                $fabricacao = \app\models\FabricacaoSearch::findOne(['id' => $model->fabricacao_fk]);

                if ($post['FabricacaoHistoricoSearch']['qnt'] > $model->qnt) {

                    $modelHitorico->qnt = ($post['FabricacaoHistoricoSearch']['qnt'] - $model->qnt);
                    $modelHitorico->status = '1';
                    $fabricacao->qnt = $fabricacao->qnt + $modelHitorico->qnt;
                } else {

                    $modelHitorico->qnt = ($model->qnt - $post['FabricacaoHistoricoSearch']['qnt']);
                    $modelHitorico->status = '2';
                    $fabricacao->qnt = $fabricacao->qnt - $modelHitorico->qnt;
                }
                $modelHitorico->fabricacao_fk = $model->fabricacao_fk;
                $modelHitorico->pessoa = 'Ajuste Sistema';
                $modelHitorico->save();
                $model->load($post);
                $fabricacao->save();
                $model->save();
            }
            return $this->redirect(['fabricacao/view', 'id' => $model->fabricacao_fk]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FabricacaoHistorico model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FabricacaoHistorico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return FabricacaoHistorico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = FabricacaoHistoricoSearch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
