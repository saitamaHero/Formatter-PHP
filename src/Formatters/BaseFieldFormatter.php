<?php

namespace App\Formatters;

abstract class BaseFieldFormatter implements IFieldFormatter
{
    protected $params = [];

    /**
     * Set the params configuration to be applyed
     *
     * @param array $params
     * @return void
     */
    public function setParams(array $params)
    {
        $this->params = array_merge($this->params, $params);
    }

    /**
     * Apply params and transform the value
     *
     * @param mixed $value
     * @return mixed
     */
    protected abstract function transform($value);


    public function getParam(string $key)
    {
        if (!key_exists($key, $this->params)) {
            return null;
        }


        return $this->params[$key];
    }

    public function format($value, array $params)
    {
        $this->setParams($params);

        return $this->transform($value);
    }
}
