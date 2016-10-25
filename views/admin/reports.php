<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::t('app', 'Reports');
?>
<div class="report-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'user_name',
                'label' => \Yii::t('app', 'User')
            ],
            [
                'attribute' => 'amount',
                'label' => \Yii::t('app','Amount ($)'),
                'format' => 'decimal'
            ],
            [
                'class' => '\app\grid\ArticleColumn',
                'attribute' => 'article'
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => ''
            ]

        ],
    ]); ?>
</div>
