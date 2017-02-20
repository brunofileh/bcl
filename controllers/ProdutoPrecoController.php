<?php

namespace app\controllers;

use Yii;
use app\models\ProdutoPreco;
use app\models\ProdutoPrecoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ProdutoSearch;
use app\models\CorPanoSearch;
use yii\helpers\ArrayHelper;

/**
 * ProdutoPrecoController implements the CRUD actions for ProdutoPreco model.
 */
class ProdutoPrecoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all ProdutoPreco models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProdutoPrecoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProdutoPreco model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProdutoPreco model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProdutoPreco();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
			$cor = ArrayHelper::map(CorPanoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
			$produto = ArrayHelper::map(ProdutoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');

            return $this->render('create', [
                'model'		=> $model,
				'produto'	=> $produto,
				'cor'		=> $cor
				
            ]);
        }
    }

    /**
     * Updates an existing ProdutoPreco model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
			$cor = ArrayHelper::map(CorPanoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
			$produto = ArrayHelper::map(ProdutoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
            return $this->render('update', [
                'model' => $model,
				'produto'	=> $produto,
				'cor'		=> $cor
            ]);
        }
    }

    /**
     * Deletes an existing ProdutoPreco model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProdutoPreco model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ProdutoPreco the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProdutoPreco::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 
	
	
	public function actionGetPrecoProduto()
    {
        $post = Yii::$app->request->post();
		
		if($post['produto_preco_fk']){
			echo 'asedf';
		}else{
			$produtoPrecoCopia = ProdutoPrecoSearch::find()->where(['produto_fk'=>$post['produto_fk']])->orderBy('id desc')->asArray()->one();
		}
		
		//$this->app->response->format = \yii\web\Response::FORMAT_JSON;
		echo json_encode($produtoPrecoCopia);			
    }
	
	public function actionVerificaExite()
    {
        $post = Yii::$app->request->post();
		
		$produto = ProdutoPrecoSearch::find()->where(['produto_fk'=>$post['produto_fk'], 'cor_pano_fk'=>$post['cor_pano_fk']])->orderBy('id desc')->asArray()->one();

		echo json_encode($produto);			
    }

}
