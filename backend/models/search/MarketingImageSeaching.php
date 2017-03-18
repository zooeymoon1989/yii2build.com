<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MarketingImage;

/**
 * MarketingImageSeaching represents the model behind the search form about `backend\models\MarketingImage`.
 */
class MarketingImageSeaching extends MarketingImage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'marketing_image_is_featured', 'marketing_image_is_active', 'marketing_image_weight', 'status_id'], 'integer'],
            [['marketing_image_path', 'marketing_image_name', 'marketing_image_caption', 'created_at', 'updated_at'], 'safe'],
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
        $query = MarketingImage::find();

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
            'marketing_image_is_featured' => $this->marketing_image_is_featured,
            'marketing_image_is_active' => $this->marketing_image_is_active,
            'marketing_image_weight' => $this->marketing_image_weight,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'marketing_image_path', $this->marketing_image_path])
            ->andFilterWhere(['like', 'marketing_image_name', $this->marketing_image_name])
            ->andFilterWhere(['like', 'marketing_image_caption', $this->marketing_image_caption]);

        return $dataProvider;
    }
}
