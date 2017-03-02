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
        
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Fabricacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new Fabricacao();
        $modelHitorico = new \app\models\FabricacaoHistoricoSearch();

        $produto = ArrayHelper::map(\app\models\VisProduto::find()->select("produto_preco_fk, descricao")->orderBy('descricao')->all(), 'produto_preco_fk', 'descricao');
        $classificacao = ArrayHelper::map(\app\models\ClassificacaoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
        $desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
        $status = [1 => 'Riscado', 2 => 'Bordando Terceiros', 3 => 'Bordado', 4 => 'Pronto'];

        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            $modelExiste = Fabricacao::findOne(['classificacao_fk' => $model->classificacao_fk, 'produto_preco_fk' => $model->produto_preco_fk, 'desenho_fk' => $model->desenho_fk, 'status' => $model->status]);


            if ($modelExiste) {

                $qtd = $model->qnt;
                $modelExiste->qnt = $modelExiste->qnt + $model->qnt;
                $model = $modelExiste;
            } else {

                $qtd = $model->qnt;
            }

            if ($model->save()) {

                $modelHitorico->load(Yii::$app->request->post());
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
                        'classificacao' => $classificacao,
                        'desenho' => $desenho,
                        'status' => $status,
                        'modelHitorico' => $modelHitorico,
            ]);
        }
    }

    /**
     * Updates an existing Fabricacao model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelHitorico = new \app\models\FabricacaoHistoricoSearch();
        
        $produto = ArrayHelper::map(\app\models\VisProduto::find()->select("produto_preco_fk, descricao")->orderBy('descricao')->all(), 'produto_preco_fk', 'descricao');
        $classificacao = ArrayHelper::map(\app\models\ClassificacaoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
        $desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
        
        $status = [1 => 'Riscado', 2 => 'Bordando Terceiros', 3 => 'Bordado', 4 => 'Pronto'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'produto' => $produto,
                        'classificacao' => $classificacao,
                        'desenho' => $desenho,
                        'status' => $status,
                        'modelHitorico' => $modelHitorico,
            ]);
        }
    }

    public function actionMudaStatus($id) {
        $model = $this->findModel($id);
        $modelNovo = new Fabricacao();
        $modelHitorico = new \app\models\FabricacaoHistoricoSearch();
        
        $produto = ArrayHelper::map(\app\models\VisProduto::find()->select("produto_preco_fk, descricao")->orderBy('descricao')->all(), 'produto_preco_fk', 'descricao');
        $classificacao = ArrayHelper::map(\app\models\ClassificacaoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
        $desenho = ArrayHelper::map(\app\models\DesenhoSearch::find()->select("id, descricao")->orderBy('descricao')->all(), 'id', 'descricao');
        
        $status = [1 => 'Riscado', 2 => 'Bordando Terceiros', 3 => 'Bordado', 4 => 'Pronto'];
        
        unset($status[$model->status]);
        
        if ($modelNovo->load(Yii::$app->request->post())) {
           $modelNovo->classificacao_fk = $model->classificacao_fk;
           $modelNovo->produto_preco_fk = $model->produto_preco_fk;
           $modelNovo->desenho_fk = $model->desenho_fk;
                      
            $modelExiste = Fabricacao::findOne(['classificacao_fk' => $model->classificacao_fk, 'produto_preco_fk' => $model->produto_preco_fk, 'desenho_fk' => $model->desenho_fk, 'status' => $modelNovo->status]);

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
            }
            
            $model->qnt = $model->qnt - $qtd;
            $model->save();
            
			if($modelNovo->status==4){
				$estoque = \app\models\EstoqueSearch::findOne(['classificacao_fk' => $model->classificacao_fk, 'produto_preco_fk' => $model->produto_preco_fk, 'desenho_fk' => $model->desenho_fk]);
				
				if($estoque){
					$estoque->qnt_diponivel = $estoque->qnt_diponivel+$modelNovo->status;
					$estoque->save();
				}else{
					$estoqueMod = \app\models\EstoqueSearch::findOne(['produto_preco_fk' => $model->produto_preco_fk]);
					
					if($estoqueMod){
						$estoque = new \app\models\EstoqueSearch();
						$estoque->classificacao_fk = $model->classificacao_fk;
						$estoque->produto_fk = $model->classificacao_fk;
					}
					
				}
			}

            return $this->redirect(['view', 'id' => $modelNovo->id]);
        } else {
            return $this->render('muda-status', [
                        'model' => $model,
                        'modelNovo' => $modelNovo,
                        'produto' => $produto,
                        'classificacao' => $classificacao,
                        'desenho' => $desenho,
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
        $this->findModel($id)->delete();

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
