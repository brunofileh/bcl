<?php

namespace app\controllers;

use Yii;
use app\models\ProdutoComercial;
use app\models\ProdutoComercialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ProdutoComercialController implements the CRUD actions for ProdutoComercial model.
 */
class ProdutoComercialController extends Controller {

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
	 * Lists all ProdutoComercial models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new \app\models\VisProdutoComercialSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single ProdutoComercial model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render('view', [
				'model' => \app\models\VisProdutoComercialSearch::find()->where(['id' => $id])->one(),
		]);
	}

	/**
	 * Creates a new ProdutoComercial model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new ProdutoComercialSearch();

		$produto = ArrayHelper::map(\app\models\ProdutoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
		$classificacao = ArrayHelper::map(\app\models\ClassificacaoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
		$desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
		$corPano = ArrayHelper::map(\app\models\CorPanoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

		$modelVis = new \app\models\VisProdutoComercialSearch();
		$produto_preco = $modelVis->search(Yii::$app->request->queryParams);
					
		//print_r($model->attributes); exit;
		if ($model->load(Yii::$app->request->post())) {

			if (!$model->preco_fk) {

				$preco = new \app\models\PrecoSearch();
				$preco->load(Yii::$app->request->post());
				$preco->save();
				$model->preco_fk = $preco->id;
			}

			if ($model->save()) {

				return $this->redirect(['view', 'id' => $model->id]);
			}
		}

		return $this->render('create', compact(['model', 'produto', 'classificacao', 'desenho', 'corPano', 'produto_preco', 'modelVis']));
	}

	/**
	 * Updates an existing ProdutoComercial model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		$produto = ArrayHelper::map(\app\models\ProdutoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
		$classificacao = ArrayHelper::map(\app\models\ClassificacaoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
		$desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
		$corPano = ArrayHelper::map(\app\models\CorPanoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

		$modelVis = new \app\models\VisProdutoComercialSearch();
		$produto_preco = $modelVis->search(Yii::$app->request->queryParams);
		/*$entao = $modelVis->search(Yii::$app->request->queryParams, false);
		
		
		if($entao){
			foreach ($entao as $key => $value) {
				if($value->preco_fk==$model->preco_fk){
					$paginacao = [$key=>$key, 'cont'=>count($entao)];
				}
			}
		}
print_r($paginacao); exit;
		$produto_preco = $modelVis->search(Yii::$app->request->queryParams);*/
		//print_r('a'); exit;
		
////	if($entao->all()){
////			$pag = 1;
////			foreach ($entao as $key => $value) {
////				if($value->preco_fk==$model->preco_fk){
////					$pag = $key;
////				}
////			}
//		}
		
		if (Yii::$app->request->post()) {
			$model->load(Yii::$app->request->post());
			$model->save();
			
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		}
		return $this->render('update', compact(['model', 'produto', 'classificacao', 'desenho', 'corPano', 'produto_preco', 'modelVis']));
	}

	/**
	 * Deletes an existing ProdutoComercial model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the ProdutoComercial model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return ProdutoComercial the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = ProdutoComercialSearch::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionIncluirProduto() {

		$post = Yii::$app->request->post();
		$model = null;

		$model = new \app\models\ProdutoSearch();
		$model->attributes = $post['ProdutoSearch'];
		$model->unidade = 1;
		if ($model->save()) {

			$str = 'Inclusão com sucesso';

			$msg['tipo'] = 'success';
			$msg['msg'] = $str . ' efetivada com sucesso.';
			$msg['icon'] = 'check';

			//$desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

			$existente = \app\models\ProdutoSearch::find()
				->select("id, descricao")
				->asArray()
				->orderBy('descricao')
				->all();

			if ($existente) {
				$html .= "<option value=''>-- selecione --</option>";
				foreach ($existente as $key => $value) {
					$html .= "<option value='" . $value['id'] . "'>" . $value['descricao'] . "</option>";
				}
			} else {
				$html .= "<option value=''>Nenhum registro encontrado</option>";
			}


			$dados = ['dados' => $html, 'valor' => $model->id, 'msg' => $msg];
		} else {
			$msg = $model->getErrors();

			$msg['tipo'] = 'error';
			$msg['msg'] = 'Erro incluir' . $msg;
			$msg['icon'] = 'error';

			$dados = ['msg' => $msg];
		}



		return \yii\helpers\Json::encode($dados);
	}

	public function actionIncluirCorPano() {

		$post = Yii::$app->request->post();
		$model = null;

		$model = new \app\models\CorPanoSearch();
		$model->setScenario('produtoComercial');
		$model->attributes = $post['CorPanoSearch'];

		if ($model->save()) {

			$str = 'Inclusão com sucesso';

			$msg['tipo'] = 'success';
			$msg['msg'] = $str . ' efetivada com sucesso.';
			$msg['icon'] = 'check';

			//$desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

			$existente = \app\models\CorPanoSearch::find()
				->select("id, descricao")
				->asArray()
				->orderBy('descricao')
				->all();

			if ($existente) {
				$html .= "<option value=''>-- selecione --</option>";
				foreach ($existente as $key => $value) {
					$html .= "<option value='" . $value['id'] . "'>" . $value['descricao'] . "</option>";
				}
			} else {
				$html .= "<option value=''>Nenhum registro encontrado</option>";
			}


			$dados = ['dados' => $html, 'valor' => $model->id, 'msg' => $msg];
		} else {
			$msg = $model->getErrors();

			$msg['tipo'] = 'error';
			$msg['msg'] = 'Erro incluir' . $msg;
			$msg['icon'] = 'error';

			$dados = ['msg' => $msg];
		}



		return \yii\helpers\Json::encode($dados);
	}

	public function actionIncluirDesenho() {

		$post = Yii::$app->request->post();
		$model = null;

		$model = new \app\models\DesenhoSearch();
		$model->setScenario('produtoComercial');
		$model->attributes = $post['DesenhoSearch'];

		if ($model->save()) {

			$str = 'Inclusão com sucesso';

			$msg['tipo'] = 'success';
			$msg['msg'] = $str . ' efetivada com sucesso.';
			$msg['icon'] = 'check';

			//$desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

			$existente = \app\models\DesenhoSearch::find()
				->select("id, descricao")
				->asArray()
				->orderBy('descricao')
				->all();

			if ($existente) {
				$html .= "<option value=''>-- selecione --</option>";
				foreach ($existente as $key => $value) {
					$html .= "<option value='" . $value['id'] . "'>" . $value['descricao'] . "</option>";
				}
			} else {
				$html .= "<option value=''>Nenhum registro encontrado</option>";
			}


			$dados = ['dados' => $html, 'valor' => $model->id, 'msg' => $msg];
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
		$model->setScenario('produtoComercial');
		$model->attributes = $post['ClassificacaoSearch'];


		if ($model->save()) {

			$str = 'Inclusão com sucesso';

			$msg['tipo'] = 'success';
			$msg['msg'] = $str . ' efetivada com sucesso.';
			$msg['icon'] = 'check';

			//$desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

			$existente = \app\models\ClassificacaoSearch::find()
				->select("id, descricao")
				->asArray()
				->orderBy('descricao')
				->all();

			if ($existente) {
				$html .= "<option value=''>-- selecione --</option>";
				foreach ($existente as $key => $value) {
					$html .= "<option value='" . $value['id'] . "'>" . $value['descricao'] . "</option>";
				}
			} else {
				$html .= "<option value=''>Nenhum registro encontrado</option>";
			}


			$dados = ['dados' => $html, 'valor' => $model->id, 'msg' => $msg];
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
