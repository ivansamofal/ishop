<?php
namespace common\components\exception;

use yii\helpers\Html;

/**
 * Class NoGoodsException
 * @package common\components\exception
 */
class NoGoodsException extends \Exception
{
    const MESSAGE = 'This is message about error!';
    const CODE = 500;

    /**
     * NoGoodsException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE, null);
    }

    /**
     * @return string
     */
    public function testMessage()
    {
        return Html::encode('This is test exception message');
    }
}