<?php

namespace api;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'api\controllers';

    public function init()
    {
        parent::init();
    }

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()
            ->addRules([
                ['class' => '\yii\rest\UrlRule', 'controller' => ['api/operation'], 'only' => ['create', 'index']],
                ['class' => '\yii\rest\UrlRule', 'controller' => ['api/report'], 'only' => ['create', 'index']]
        ]);
    }
}