<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operations".
 *
 * @property integer $id
 * @property string $amount
 * @property integer $is_debit
 * @property integer $is_for_user
 * @property integer $user_id
 * @property string $comment
 * @property integer $created_at
 *
 * @property Users $user
 * @property Reports[] $reports
 */
class Operation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operations';
    }

    public function behaviors()
    {
        return [
            [
                'class'              => \yii\behaviors\TimestampBehavior::className(),
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
            [['amount'], 'number', 'min' => 0.01],
            [['is_debit', 'is_for_user', 'user_id', 'created_at'], 'integer'],
            [['comment'], 'string'],
            [['amount'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => \Yii::t('app', 'ID'),
            'amount'      => \Yii::t('app','Amount'),
            'is_debit'    => \Yii::t('app','Is Debit'),
            'is_for_user' => \Yii::t('app','Is For User'),
            'user_id'     => \Yii::t('app','User ID'),
            'comment'     => \Yii::t('app','Comment'),
            'created_at'  => \Yii::t('app','Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getCashAmount()
    {
        return Yii::$app
            ->db
            ->createCommand(
                'SELECT IFNULL(debit.sum, 0) - IFNULL(credit.sum, 0) FROM
                  (SELECT SUM(amount) `sum` FROM `operations` WHERE is_debit = 1) as debit
                  LEFT JOIN
                  (SELECT SUM(amount) `sum` FROM `operations` where `is_debit` = 0) as credit ON TRUE')
            ->queryScalar();
    }
}
