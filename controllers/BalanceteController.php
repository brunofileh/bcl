<?php

namespace app\controllers;

use Yii;
use app\models\Balancete;
use app\models\BalanceteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BalanceteController implements the CRUD actions for Balancete model.
 */
class BalanceteController extends Controller {

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
	 * Lists all Balancete models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new BalanceteSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Balancete model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
				'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Balancete model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Balancete();

		$entradas = \app\models\KardexSearch::find()->where("entrada_saida=1 and to_char(data_inclusao, 'MMYYYY')='" . date('mY') . "'")->all();
		$saidas = \app\models\KardexSearch::find()->where("entrada_saida=2 and to_char(data_inclusao, 'MMYYYY')='" . date('mY') . "'")->all();

		$ent = $sat = [];
		if ($entradas) {
			foreach ($entradas as $key => $entrada) {
				if ($entrada->itens_movimentacao_fk) {
					$ent['mov']['total'] += $entrada->valor * $entrada->qnt;
					$ent['mov']['custo'] += $entrada->custo * $entrada->qnt;
				} elseif ($entrada->saida_simples_fk) {
					$ent['sim']['total'] += $entrada->valor * $entrada->qnt;
					$ent['sim']['custo'] += $entrada->custo * $entrada->qnt;
				} else {
					$ent['bor']['total'] += $entrada->valor * $entrada->qnt;
					$ent['bor']['custo'] += $entrada->custo * $entrada->qnt;
				}
			}
		}
		if ($saidas) {
			foreach ($saidas as $key => $saida) {
				if ($entrada->itens_movimentacao_fk) {
					$sat['mov']['total'] += $saida->custo * $saida->qnt;
					$sat['mov']['custo'] += $saida->custo * $saida->qnt;
				} elseif ($entrada->saida_simples_fk) {
					$sat['sim']['total'] += $saida->custo * $saida->qnt;
					$sat['sim']['custo'] += $saida->custo * $saida->qnt;
				} else {
					$sat['bor']['total'] += $saida->custo * $saida->qnt;
					$sat['bor']['custo'] += $saida->custo * $saida->qnt;
				}
			}
		}


		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing Balancete model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Balancete model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Balancete model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Balancete the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Balancete::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
