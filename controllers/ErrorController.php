<?php
namespace app\controllers;

use yii\web\Controller;

class ErrorController extends Controller
{
    public $defaultAction = 'error';
    public $layout = 'error';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }
}
