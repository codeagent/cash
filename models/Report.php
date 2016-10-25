<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reports".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $operation_id
 * @property string $amount
 * @property integer $article
 * @property integer $created_at
 *
 * @property Users $user
 * @property Operations $operation
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reports';
    }

    public function behaviors()
    {
        return [
            [
                'class'              => 'yii\behaviors\TimestampBehavior',
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'article'], 'required'],
            [['user_id', 'article', 'created_at'], 'integer'],
            [['amount'], 'number', 'min' => 0.01, 'max' => abs(\Yii::$app->user->getIdentity()->balance)],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => \Yii::t('app', 'ID'),
            'user_id'    => \Yii::t('app', 'User ID'),
            'amount'     => \Yii::t('app', 'Amount'),
            'article'    => \Yii::t('app', 'Article'),
            'created_at' => \Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
