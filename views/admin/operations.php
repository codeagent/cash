<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OperationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('app', 'Operations');

?>
<div class="report-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => \Yii::t('app', 'User'),
                'attribute' => 'user_name',
                'value' => function($value) {
                    if(empty($value->user_name))
                        return '';

                    return $value->user_name . " (" . $value->user_balance . "$) ";
                }
            ],
            [
                'attribute' => 'amount',
                'label' => \Yii::t('app','Amount ($)'),
                'format' => 'decimal'
            ],
            [
                'label' => \Yii::t('app','Type'),
                'attribute' => 'is_debit',
                'value' => function($value, $model, $key, $index) {
                    $map = [
                        0 => '<span class="label label-danger">' . \Yii::t('app', 'Withdrawal'). '</span>',
                        1 => '<span class="label label-success">' . \Yii::t('app', 'Entry'). '</span>'
                    ];
                    return "<div class='text-center'>{$map[$value->is_debit]}</div>";
                },
                'format' => 'raw',
                'filter' => [
                    0 => \Yii::t('app', 'Withdrawal'),
                    1 => \Yii::t('app', 'Entry')
                ]
            ],

            [
                'label' => \Yii::t('app','For user'),
                'attribute' => 'is_for_user',
                'value' => function($value, $model, $key, $index) {
                    return $value->is_for_user ? \Yii::t('app', 'Yes')  : \Yii::t('app', 'No');
                },
                'format' => 'raw',
                'filter' => [
                    0 => \Yii::t('app', 'No'),
                    1 => \Yii::t('app', 'Yes')
                ]
            ],

            [
                'label' => \Yii::t('app','Time'),
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => ''
            ],

            'comment'

        ],
    ]); ?>
</div>
