<?php
namespace common\components\example;

/**
 * Class BaseService
 * @package common\components\example
 */
abstract class BaseService implements ServiceInterface
{
    const MULTIPLIER = 0;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * BaseService constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    /**
     * @inheritdoc
     */
    public function getResult()
    {
        return array_map(function ($item) {
            return ($item * static::MULTIPLIER) - 1;
        }, $this->getData());
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data = [])
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}