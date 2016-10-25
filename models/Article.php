<?php
namespace app\models;

class Article
{
    /**
     * @var array storage
     */
    protected static $catalog = [
        1 => 'Article 1',
        2 => 'Article 2',
        3 => 'Article 3'
    ];

    public static function getById($id)
    {
        if(!isset(static::$catalog[$id]))
            return null;

        return static::$catalog[$id];
    }

    public static function getCatalog()
    {
        return static::$catalog;
    }
}