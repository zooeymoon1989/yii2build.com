<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "marketing_image".
 *
 * @property string $id
 * @property string $marketing_image_path
 * @property string $marketing_image_name
 * @property string $marketing_image_caption
 * @property integer $marketing_image_is_featured
 * @property integer $marketing_image_is_active
 * @property integer $marketing_image_weight
 * @property integer $status_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Status $status
 */
class MarketingImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marketing_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marketing_image_path', 'marketing_image_name', 'status_id', 'created_at', 'updated_at'], 'required'],
            [['marketing_image_is_featured', 'marketing_image_is_active', 'marketing_image_weight', 'status_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['marketing_image_path', 'marketing_image_name'], 'string', 'max' => 45],
            [['marketing_image_caption'], 'string', 'max' => 100],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marketing_image_path' => 'Marketing Image Path',
            'marketing_image_name' => 'Marketing Image Name',
            'marketing_image_caption' => 'Marketing Image Caption',
            'marketing_image_is_featured' => 'Marketing Image Is Featured',
            'marketing_image_is_active' => 'Marketing Image Is Active',
            'marketing_image_weight' => 'Marketing Image Weight',
            'status_id' => 'Status ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
    }
}
