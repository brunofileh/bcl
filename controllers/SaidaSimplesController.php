<?php

namespace app\controllers;

use Yii;
use app\models\SaidaSimples;
use app\models\SaidaSimplesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SaidaSimplesController implements the CRUD actions for SaidaSimples model.
 */
class SaidaSimplesController extends Controller {

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
	 * Lists all SaidaSimples models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new SaidaSimplesSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single SaidaSimples model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
				'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new SaidaSimples model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new SaidaSimplesSearch();
			$this->view->title = "Entrada e saída simples";
			
		if ($model->load(Yii::$app->request->post())) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$model->save();
				$kardex = new \app\models\KardexSearch();
				$kardex->entrada_saida = $model->entrada_saida;
				$kardex->saida_simples_fk = $model->id;
				$kardex->valor = $model->valor;
				$kardex->qnt = 1;
				$kardex->save();

				$transaction->commit();
			} catch (\Exception $e) {
				$transaction->rollBack();
				throw $e;
			}
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing SaidaSimples model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		$this->view->title = ($model->entrada_saida == 1) ? "Entrada Simples" : "Saida Simples";
		
		if ($model->load(Yii::$app->request->post())) {
			$transaction = Yii::$app->db->beginTransaction();

			try {
				$model->save();
				
				$kardex = \app\models\KardexSearch::findOne(['saida_simples_fk' => $model->id]);
				$kardex->valor = $model->valor;
				$kardex->save();
				$transaction->commit();
			} catch (\Exception $e) {
				$transaction->rollBack();
				throw $e;
			}


			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing SaidaSimples model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$model = $this->findModel($id);
		$transaction = Yii::$app->db->beginTransaction();
		try {
			$kardex = new \app\models\KardexSearch();
			$kardex->entrada_saida = ($model->entrada_saida == 1) ? '2' : '1';
			$kardex->saida_simples_fk = $model->id;
			$kardex->valor = $model->valor;
			$kardex->qnt = 1;
			$kardex->save();

			$model->data_exclusao = date('d/m/Y');
			$model->save();
			$transaction->commit();
		} catch (\Exception $e) {
			$transaction->rollBack();
			throw $e;
		}
		return $this->redirect(['index']);
	}

	/**
	 * Finds the SaidaSimples model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return SaidaSimples the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = SaidaSimplesSearch::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
