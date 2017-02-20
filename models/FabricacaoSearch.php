<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fabricacao;

/**
 * FabricacaoSearch represents the model behind the search form about `app\models\Fabricacao`.
 */
class FabricacaoSearch extends Fabricacao
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'classificacao_fk', 'produto_preco_fk', 'desenho_fk', 'qnt', 'status'], 'integer'],
            [['data_inclusao', 'obs'], 'safe'],
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
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Fabricacao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'data_inclusao' => $this->data_inclusao,
            'classificacao_fk' => $this->classificacao_fk,
            'produto_preco_fk' => $this->produto_preco_fk,
			'desenho_fk' => $this->desenho_fk,
            'qnt' => $this->qnt,
            'status' => $this->status,
        ]);

        //$query->andFilterWhere(['like', 'desenho', $this->desenho]);

        return $dataProvider;
    }
	
	
	  /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassificacaoFk()
    {
        return $this->hasOne(ClassificacaoSearch::className(), ['id' => 'classificacao_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesenhoFk()
    {
        return $this->hasOne(DesenhoSearch::className(), ['id' => 'desenho_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoPrecoFk()
    {
        return $this->hasOne(ProdutoPrecoSearch::className(), ['id' => 'produto_preco_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFabricacaoHistoricos()
    {
        return $this->hasMany(FabricacaoHistoricoSearch::className(), ['fabricacao_fk' => 'id']);
    }
}
