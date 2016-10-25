<?php
namespace app\grid;

use app\models\Article;

class ArticleColumn extends \yii\grid\DataColumn
{

    public function init()
    {
        $this->filter = Article::getCatalog();
    }

    public function renderDataCellContent($model, $key, $index)
    {

        return Article::getById($model->{$this->attribute});
    }
}
