<?php

namespace app\controllers;

use Yii;
use app\models\Fabricacao;
use app\models\FabricacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * FabricacaoController implements the CRUD actions for Fabricacao model.
 */
class FabricacaoController extends Controller {

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
	 * Lists all Fabricacao models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new \app\models\VisFabricacaoSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		$this->view->title = "Lista de Produtos Estoque de Fabricação";
		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Fabricacao model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id) {
		$model = \app\models\VisFabricacaoSearch::findOne(['id' => $id]);
		$status = [1 => 'Riscar', 2 => 'Bordar Terceiros', 3 => 'Bordar', 4 => 'Pronto'];

		$this->view->title = "Fabricação: {$status[$model->status]} - " . $model->produto;
		return $this->render('view', [
				'model' => $model,
		]);
	}

	/**
	 * Creates a new Fabricacao model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {

		$model = new FabricacaoSearch();
		$modelHitorico = new \app\models\FabricacaoHistoricoSearch();
		$this->view->title = "Cadastrar Estoque de Fabricação";

		$produto = \app\models\VisProdutoComercialSearch::find()->select(['produto_comercial as value', 'produto_comercial as  label', 'id as id'])->asArray()->all();

		$status = [1 => 'Riscado', 2 => 'Bordando Terceiros', 3 => 'Bordado', 5 => 'Costurado', 4 => 'Pronto'];

		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());


			$modelExiste = Fabricacao::findOne(['produto_comercial_fk' => $model->produto_comercial_fk, 'status' => $model->status]);

			if ($modelExiste) {

				$qtd = $model->qnt;
				$modelExiste->qnt = $modelExiste->qnt + $model->qnt;
				$model = $modelExiste;
			} else {

				$qtd = $model->qnt;
			}
			$transaction = Yii::$app->db->beginTransaction();

			try {
				if ($model->save()) {

					$modelHitorico->load(Yii::$app->request->post());
					$modelHitorico->qnt = $qtd;
					$modelHitorico->fabricacao_fk = $model->id;
					$modelHitorico->status = '1';
					$modelHitorico->save();

					if ($modelHitorico->pago_status) {
						$kardex = new \app\models\KardexSearch();
						$kardex->entrada_saida = '2';
						$kardex->fabricacao_historico_fk = $modelHitorico->id;

						$produto = \app\models\VisProdutoComercialSearch::findOne(['id' => $model->produto_comercial_fk]);

						switch ($model->status) {
							case '1': $kardex->valor = $produto->risco;
								break;
							case '2':
							case '3': $kardex->valor = $produto->bordado;
								break;
							case '4': $kardex->valor = $produto->costureira;
								break;
						}

						$kardex->valor = \app\models\Models::decimalFormatForBank($kardex->valor);
						$kardex->qnt = $modelHitorico->qnt;
						$kardex->save();
					}
				}
				$transaction->commit();
			} catch (\Exception $e) {
				$transaction->rollBack();
				throw $e;
			}

			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
					'model' => $model,
					'produto' => $produto,
					'status' => $status,
					'modelHitorico' => $modelHitorico,
			]);
		}
	}

	public function actionMudaStatus($id) {

		$model = \app\models\VisFabricacaoSearch::findOne(['id' => $id]);
		$modelNovo = new Fabricacao();
		$modelHitorico = new \app\models\FabricacaoHistoricoSearch();

		$produto = ArrayHelper::map(\app\models\VisProdutoComercialSearch::find()->select("id, produto_comercial")->orderBy('produto_comercial')->all(), 'id', 'produto_comercial');

		$status = [1 => 'Riscado', 2 => 'Bordando Terceiros', 3 => 'Bordado', 5 => 'Costurado', 4 => 'Pronto'];
		$this->view->title = "Alterar Estágio de Fabricação: {$model->status_descricao} - " . $model->produto;

		unset($status[$model->status]);

		if ($modelNovo->load(Yii::$app->request->post())) {
			$model = $this->findModel($id);

			$modelNovo->produto_comercial_fk = $model->produto_comercial_fk;

			$modelExiste = Fabricacao::findOne(['produto_comercial_fk' => $model->produto_comercial_fk, 'status' => $modelNovo->status]);

			if ($modelExiste) {

				$qtd = $modelNovo->qnt;
				$modelExiste->qnt = $modelExiste->qnt + $modelNovo->qnt;
				$modelNovo = $modelExiste;
			} else {

				$qtd = $modelNovo->qnt;
			}

			if ($modelNovo->save()) {

				$modelHitorico = new \app\models\FabricacaoHistoricoSearch();
				$modelHitorico->load(Yii::$app->request->post());
				$modelHitorico->qnt = $qtd;
				$modelHitorico->fabricacao_fk = $modelNovo->id;
				$modelHitorico->status = '1';
				$modelHitorico->save();

				$modelHitorico = new \app\models\FabricacaoHistoricoSearch();
				$modelHitorico->load(Yii::$app->request->post());
				$modelHitorico->qnt = $qtd;
				$modelHitorico->fabricacao_fk = $model->id;
				$modelHitorico->status = '2';
				$modelHitorico->save();

				if ($modelHitorico->pago_status) {
					$kardex = new \app\models\KardexSearch();
					$kardex->entrada_saida = '2';
					$kardex->fabricacao_historico_fk = $modelHitorico->id;

					$produto = \app\models\VisProdutoComercialSearch::findOne(['id' => $model->produto_comercial_fk]);

					switch ($model->status) {
						case '1': $kardex->valor = $produto->risco;
							break;
						case '2':
						case '3': $kardex->valor = $produto->bordado;
							break;
						case '4': $kardex->valor = $produto->costureira;
							break;
					}

					$kardex->valor = \app\models\Models::decimalFormatForBank($kardex->valor);
					$kardex->qnt = $modelHitorico->qnt;
					$kardex->save();
				}
			}

			$model->qnt = $model->qnt - $qtd;
			$model->save();

			//inclui estoque
			if ($modelNovo->status == 4) {

				$estoqueExiste = \app\models\EstoqueSearch::findOne(['produto_comercial_fk' => $model->produto_comercial_fk]);

				if ($estoqueExiste) {

					$qtd = $modelNovo->qnt;
					$estoqueExiste->qnt_diponivel = $estoqueExiste->qnt_diponivel + $modelNovo->qnt;
					$estoque = $estoqueExiste;
				} else {
					$estoque = new \app\models\EstoqueSearch();
					$qtd = $modelNovo->qnt;
					$estoque->qnt_diponivel = $qnt;
					$estoque->produto_comercial_fk = $modelNovo->produto_comercial_fk;
				}

				if ($estoque->save()) {

					$modelHitorico = new \app\models\FabricacaoHistoricoSearch();
					$modelHitorico->load(Yii::$app->request->post());
					$modelHitorico->qnt = $qtd;
					$modelHitorico->fabricacao_fk = $modelNovo->id;
					$modelHitorico->status = '2';
					$modelHitorico->save();
				}
			}

			return $this->redirect(['view', 'id' => $modelNovo->id]);
		} else {
			return $this->render('muda-status', [
					'model' => $model,
					'modelNovo' => $modelNovo,
					'produto' => $produto,
					'status' => $status,
					'modelHitorico' => $modelHitorico,
			]);
		}
	}

	/**
	 * Deletes an existing Fabricacao model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$model = $this->findModel($id);
		$model->data_exclusao = date('d/m/Y');
		$model->save();
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Fabricacao model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Fabricacao the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = FabricacaoSearch::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionIncluirDesenho() {

		$post = Yii::$app->request->post();
		$model = null;

		$model = new \app\models\DesenhoSearch();
		$model->attributes = $post['DesenhoSearch'];


		if ($model->save()) {

			$str = 'Inclusão com sucesso';

			$msg['tipo'] = 'success';
			$msg['msg'] = $str . ' efetivada com sucesso.';
			$msg['icon'] = 'check';

			//$desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

			$desenhos = \app\models\DesenhoSearch::find()
				->select("id, descricao")
				->asArray()
				->orderBy('descricao')
				->all();

			if ($desenhos) {
				$desenhosHtml .= "<option value=''>-- selecione --</option>";
				foreach ($desenhos as $key => $value) {
					$desenhosHtml .= "<option value='" . $value['id'] . "'>" . $value['descricao'] . "</option>";
				}
			} else {
				$desenhosHtml .= "<option value=''>Nenhum registro encontrado</option>";
			}


			$dados = ['dados' => $desenhosHtml, 'msg' => $msg];
		} else {
			$msg = $model->getErrors();

			$msg['tipo'] = 'error';
			$msg['msg'] = 'Erro incluir' . $msg;
			$msg['icon'] = 'error';

			$dados = ['msg' => $msg];
		}



		return \yii\helpers\Json::encode($dados);
	}

	public function actionIncluirClassificacao() {

		$post = Yii::$app->request->post();
		$model = null;

		$model = new \app\models\ClassificacaoSearch();
		$model->attributes = $post['ClassificacaoSearch'];


		if ($model->save()) {

			$str = 'Inclusão com sucesso';

			$msg['tipo'] = 'success';
			$msg['msg'] = $str . ' efetivada com sucesso.';
			$msg['icon'] = 'check';

			//$desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

			$classificacao = \app\models\ClassificacaoSearch::find()
				->select("id, descricao")
				->asArray()
				->orderBy('descricao')
				->all();

			if ($classificacao) {
				$html .= "<option value=''>-- selecione --</option>";
				foreach ($classificacao as $key => $value) {
					$html .= "<option value='" . $value['id'] . "'>" . $value['descricao'] . "</option>";
				}
			} else {
				$html .= "<option value=''>Nenhum registro encontrado</option>";
			}


			$dados = ['dados' => $html, 'msg' => $msg];
		} else {
			$msg = $model->getErrors();

			$msg['tipo'] = 'error';
			$msg['msg'] = 'Erro incluir' . $msg;
			$msg['icon'] = 'error';

			$dados = ['msg' => $msg];
		}



		return \yii\helpers\Json::encode($dados);
	}

}
