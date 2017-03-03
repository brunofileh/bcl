<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProdutoComercial;

/**
 * ProdutoComercialSearch represents the model behind the search form about `app\models\ProdutoComercial`.
 */
class ProdutoComercialSearch extends ProdutoComercial
{
	public $preco_produto;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'desenho_fk', 'classificacao_fk', 'preco_fk', 'produto_fk', 'cor_pano_fk'], 'integer'],
			[['produto_fk'], 'unique', 'targetAttribute' => ['produto_fk', 'desenho_fk', 'classificacao_fk', 'preco_fk',  'cor_pano_fk', 'produto_fk'], 'message'=>'Já existe produto' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
	
	
	   /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desenho_fk' => 'Desenho',
            'classificacao_fk' => 'Classificacao',
            'preco_fk' => 'Preco',
            'produto_fk' => 'Produto',
            'cor_pano_fk' => 'Cor Pano',
        ];
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ProdutoComercial::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

       // $this->load($params);

      /*  if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }*/

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'desenho_fk' => $this->desenho_fk,
            'classificacao_fk' => $this->classificacao_fk,
            'preco_fk' => $this->preco_fk,
            'produto_fk' => $this->produto_fk,
            'cor_pano_fk' => $this->cor_pano_fk,
        ]);

        return $dataProvider;
    }
}
