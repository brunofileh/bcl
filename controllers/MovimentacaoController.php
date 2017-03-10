<?php

namespace app\controllers;

use Yii;
use app\models\Movimentacao;
use app\models\MovimentacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\ItensMovimentacaoSearch;

/**
 * MovimentacaoController implements the CRUD actions for Movimentacao model.
 */
class MovimentacaoController extends Controller {

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
	 * Lists all Movimentacao models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new MovimentacaoSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Movimentacao model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
				'model' => $this->findModel($id),
				'itens' => ItensMovimentacaoSearch::find()->where("movimentacao_fk={$id}")->asArray()->all()
		]);
	}

	/**
	 * Creates a new Movimentacao model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new MovimentacaoSearch();
		
		$this->view->title = "Cadastrar Estoque de Fabricação";
		$model->tipo_entrada=1;

		if ($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();

			$model->valor_frete = $post['movimentacaosearch-valor_frete-disp'];
			$model->valor_pago = $post['movimentacaosearch-valor_pago-disp'];
			$model->parcelas = $post['movimentacaosearch-parcelas-disp'];
			$model->parcela_atual = $post['movimentacaosearch-parcela_atual-disp'];
			$model->desconto = $post['movimentacaosearch-desconto-disp'];

			if ($model->save()) {
				
				foreach (\Yii::$app->session->get('itens') as $key => $value) {

					$modelItens = new \app\models\ItensMovimentacaoSearch();
					$modelItens->attributes = $value;
					$modelItens->movimentacao_fk = $model->id;
					
					$modelItens->save();
					
				}
			}

			\Yii::$app->session->set('itens', null);
			return $this->redirect(['view', 'id' => $model->id]);
		}	

		return $this->render('create', [
				'model' => $model,
		]);
	}
	
	
	/**
	 * Creates a new Movimentacao model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionPedido() {
		$model = new MovimentacaoSearch();
		$model->tipo_entrada=2;
		if ($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();

			$model->valor_frete = $post['movimentacaosearch-valor_frete-disp'];
			$model->valor_pago = $post['movimentacaosearch-valor_pago-disp'];
			$model->parcelas = $post['movimentacaosearch-parcelas-disp'];
			$model->parcela_atual = $post['movimentacaosearch-parcela_atual-disp'];
			$model->desconto = $post['movimentacaosearch-desconto-disp'];

			if ($model->save()) {
				
				foreach (\Yii::$app->session->get('itens') as $key => $value) {

					$modelItens = new \app\models\ItensMovimentacaoSearch();
					$modelItens->attributes = $value;
					$modelItens->movimentacao_fk = $model->id;
					
					$modelItens->save();
					
				}
			}

			\Yii::$app->session->set('itens', null);
			return $this->redirect(['view', 'id' => $model->id]);
		}	

		return $this->render('create', [
				'model' => $model,
		]);
	}
	

	/**
	 * Updates an existing Movimentacao model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id) {

		$model = $this->findModel($id);
//print_r(Yii::$app->request->post()); exit;

		if ($model->load(Yii::$app->request->post())) {
			$post = Yii::$app->request->post();

			$model->valor_frete = $post['movimentacaosearch-valor_frete-disp'];
			$model->valor_pago = $post['movimentacaosearch-valor_pago-disp'];
			$model->parcelas = $post['movimentacaosearch-parcelas-disp'];
			$model->parcela_atual = $post['movimentacaosearch-parcela_atual-disp'];
			$model->desconto = $post['movimentacaosearch-desconto-disp'];

			$model->save();
			;
			foreach (\Yii::$app->session->get('itens') as $key => $value) {

				if ($value['id']) {
					$modelItens = ItensMovimentacaoSearch::findOne($value['id']);
					$modelItens->attributes = $value;
					$modelItens->save();
				} else {
					$modelItens = new \app\models\ItensMovimentacaoSearch();
					$modelItens->attributes = $value;
					$modelItens->movimentacao_fk = $model->id;

					$modelItens->save();
				}
				$idsNovos[] = $modelItens->id;
			}
			if ($idsNovos) {

				$idsNovos = implode(',', $idsNovos);
				$modelItens = ItensMovimentacaoSearch::deleteAll("movimentacao_fk={$model->id} and id not in ({$idsNovos})");
			}



			return $this->redirect(['view', 'id' => $model->id]);
		} else {



			$itens = ItensMovimentacaoSearch::find()->where("movimentacao_fk={$id}")->asArray()->all();

			foreach ($itens as $value) {

				$iten[$value['id']] = $value;
			}

			\Yii::$app->session->set('itens', $iten);


			return $this->render('update', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Movimentacao model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Movimentacao model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Movimentacao the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = MovimentacaoSearch::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionIncluirItem() {

		$post = Yii::$app->request->post();
		$msg = $new = null;
		$model = null;
		$itens = \Yii::$app->session->get('itens');
		
		if ($post['ItensMovimentacaoSearch']['id'] != null) {

			
			$model = ItensMovimentacaoSearch::findOne($post['ItensMovimentacaoSearch']['id']);
			$itens[$model->estoque_fk] = $model->attributes;
			$itens[$model->estoque_fk]['descricao_produto'] = \app\models\VisEstoqueSearch::findOne(['id' => $post['ItensMovimentacaoSearch']['estoque_fk']])->produto_comercial;
		} else {

			$model = new \app\models\ItensMovimentacaoSearch();
			$model->attributes = $post['ItensMovimentacaoSearch'];
			
			if ($model->novo) {
				$itens[$model->novo] = $model->attributes;
				$itens[$model->novo]['novo'] = $model->novo;
			} else {
				$model->novo = $post['ItensMovimentacaoSearch']['estoque_fk'];
				$itens[$post['ItensMovimentacaoSearch']['estoque_fk']] = $model->attributes;
				$itens[$post['ItensMovimentacaoSearch']['estoque_fk']]['novo'] = $model->novo;
			}
			$itens[$post['ItensMovimentacaoSearch']['estoque_fk']]['descricao_produto'] = \app\models\VisEstoqueSearch::findOne(['id' => $post['ItensMovimentacaoSearch']['estoque_fk']])->produto_comercial;
		}
		

		$model->validate();

		if ($model && $model->getErrors()) {
			$msg = $model->getErrors();
			$dados = ['grid' => $this->renderAjax('/itens-movimentacao/_grid', ['msg' => $msg])];
		} else {
	
			\Yii::$app->session->set('itens', $itens);

			$str = 'Inclusão com sucesso';

			$msg['tipo'] = 'success';
			$msg['msg'] = $str . ' efetivada com sucesso.';
			$msg['icon'] = 'check';


			Yii::$app->controller->action->id = 'index';

			$dados = ['grid' => $this->renderAjax('/itens-movimentacao/_grid', ['msg' => $msg])];
		}


		return \yii\helpers\Json::encode($dados);
	}

	public function actionExcluirItem($id = null) {

		$itens = \Yii::$app->session->get('itens');

		$str = 'Exclusão da(o) com sucesso';
		unset($itens[$id]);
		\Yii::$app->session->set('itens', $itens);
		$msg['tipo'] = 'success';
		$msg['msg'] = $str;
		$msg['icon'] = 'check';


		$dados = ['grid' => $this->renderAjax('/itens-movimentacao/_grid', ['msg' => $msg])];

		return \yii\helpers\Json::encode($dados);
	}
	
	
	
	public function actionConsultaPrecoItem($id = null) {

		$post = Yii::$app->request->post();
		$estoque = \app\models\VisEstoqueSearch::findOne(['id'=>$post['ItensMovimentacaoSearch']['estoque_fk']]);

		$dados = $estoque->attributes;
		
		return \yii\helpers\Json::encode($dados);
	}

}
