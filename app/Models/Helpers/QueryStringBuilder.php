<?php

namespace Katniss\Models\Helpers;


class QueryStringBuilder
{
    private $params;
    private $url;
    private $tmpParams;

    /**
     * @param array $params
     * @param string $url
     */
    public function __construct($params, $url = '')
    {
        $this->url = $url;
        $this->params = $params;
        $this->tmpParams = $params;
    }

    /**
     * @return QueryStringBuilder
     */
    public function update($key, $value, $refresh = false)
    {
        if ($refresh) {
            $this->tmpParams = $this->params;
        }

        if (isset($this->tmpParams[$key]) || $this->tmpParams[$key] == null) {
            $this->tmpParams[$key] = $value;
        }

        return $this;
    }

    public function toString()
    {
        return $this->__toString();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $query = '';
        foreach ($this->tmpParams as $key => $value) {
            if (!empty($value) || $value == 0) {
                $query .= '&' . $key . '=' . $value;
            }
        }
        return $this->url . '?' . substr($query, 1);
    }
}
