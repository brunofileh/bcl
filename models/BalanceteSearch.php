<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Balancete;

/**
 * BalanceteSearch represents the model behind the search form about `app\models\Balancete`.
 */
class BalanceteSearch extends Balancete
{
	public $titulo;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['entrada', 'saida', 'total', 'lucro'], 'number'],
            [['mes_ano'], 'safe'],
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
            'entrada' => 'Entrada',
            'saida' => 'Saida',
            'total' => 'Total',
            'lucro' => 'Lucro',
            'mes_ano' => 'Mes Ano',
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
        $query = Balancete::find();

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
            'entrada' => $this->entrada,
            'saida' => $this->saida,
            'total' => $this->total,
            'lucro' => $this->lucro,
        ]);

        $query->andFilterWhere(['like', 'mes_ano', $this->mes_ano]);

        return $dataProvider;
    }
}
