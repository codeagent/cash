<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Report;

/**
 * ReportSearch represents the model behind the search form about `app\models\Report`.
 */
class ReportSearch extends Report
{

    public $user_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'article', 'created_at'], 'integer'],
            [['amount'], 'number'],
            [['user_name'], 'string']
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
        $query = ReportSearch::find()
            ->join('INNER JOIN', 'users', 'users.id = reports.user_id')
            ->addSelect([
                'user_name' => 'users.login'
            ])
            ->addSelect('reports.*');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => [
                'attributes'   => $this->getSortAttributes(),
                'defaultOrder' => ['created_at' => SORT_DESC]
            ]
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
            'amount' => $this->amount,
            'article' => $this->article,
            'created_at' => $this->created_at,
        ]);
        $query->andFilterWhere(['like', 'users.login', $this->user_name]);

        return $dataProvider;
    }

    protected function getSortAttributes()
    {
        $attributes = [];
        foreach (array_keys(static::getTableSchema()->columns) as $attribute)
            $attributes[$attribute] = [
                'asc'   => [$attribute => SORT_ASC],
                'desc'  => [$attribute => SORT_DESC],
                'label' => $attribute
            ];

        $attributes['user_name'] = [
            'asc'   => ['user_name' => SORT_ASC],
            'desc'  => ['user_name' => SORT_DESC],
            'label' => 'User name'
        ];

        return $attributes;
    }

}
