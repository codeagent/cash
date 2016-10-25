<?php

namespace app\controllers;

use app\models\Report;
use app\models\ReportSearch;
use app\models\OperationSearch;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
    public $layout = 'dashboard';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'matchCallback' => function($rule, $action) {
                            return \Yii::$app->user->isGuest || \Yii::$app->user->getIdentity()->is_admin;
                        }
                    ],
                    [
                        'allow' => true
                    ]
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel  = new ReportSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        $dataProvider->query->andWhere(['user_id' => \Yii::$app->user->identity->id]);

        return $this->render('reports', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOperations()
    {
        $searchModel  = new OperationSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        $dataProvider->query->andWhere(['user_id' => \Yii::$app->user->identity->id]);

        return $this->render('operations', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        return $this->render('operations');
    }

    public function actionNewReport()
    {
        $transaction =  \Yii::$app->db->beginTransaction();
        try {
            $model = new Report(['user_id' => \Yii::$app->user->identity->id]);

            if($model->load(\Yii::$app->request->post()) && $model->save()) {

                \Yii::$app->user->identity->balance += $model->amount;
                \Yii::$app->user->identity->save();

                $transaction->commit();

                \Yii::$app->crmNotifier->newReport($model);
                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Report has been created successfully.'));
                return $this->redirect(['user/index']);
            }
            else {
                return $this->render('new', [
                    'model' => $model,
                ]);
            }

        } catch(\Exception $e) {
            $transaction->rollBack();
            \Yii::$app->session->setFlash('danger', \Yii::t('app', $e->getMessage()));
            return $this->redirect(['admin/index']);
        }
    }

}