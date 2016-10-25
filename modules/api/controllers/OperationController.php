<?php
namespace api\controllers;

use \Yii;
use app\models\Operation;
use app\models\OperationSearch;
use yii\web\ForbiddenHttpException;


class OperationController extends BaseController
{
    /**
     * curl -i -H "Accept:application/json" "http://localhost:8080/api/operations?access-token=admin"
     * curl -i -H "Accept:application/json" "http://localhost:8080/api/operations?access-token=Bernard+Lindgren"
     */
    public function actionIndex()
    {
        $model = new OperationSearch();
        $dataProvider = $model->search(Yii::$app->getRequest()->get());

        if(!\Yii::$app->user->getIdentity()->is_admin) {
            $dataProvider
                ->query
                ->andWhere(['user_id' => \Yii::$app->user->getIdentity()->id]);
        }
        return $dataProvider;
    }

    /**
     * curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://localhost:8080/api/operations?access-token=admin" -d '{"is_debit": 1, "amount": 50000.00}'
     * curl -i -H "Accept:application/json" -H "Content-Type:application/json" -XPOST "http://localhost:8080/api/operations?access-token=Bernard+Lindgren" -d '{"is_debit": 1, "is_for_user": 1, "user_id": 2, "amount": 50000.00}'
     */
    public function actionCreate()
    {
        if(!\Yii::$app->user->getIdentity()->is_admin) {
            throw new ForbiddenHttpException();
        }
        $model = new Operation(['user_id' => null, 'is_for_user' => 0]);
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if($model->save()) {
            Yii::$app->response->setStatusCode(201);
        }
        return $model;
    }
}