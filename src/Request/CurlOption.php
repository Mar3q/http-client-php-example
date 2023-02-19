<?php

namespace Mar3q\HttpClientPhpExample\Request;

class CurlOption
{
    private int $option;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param int $option
     * @param $value
     */
    public function __construct(int $option, $value)
    {
        $this->option = $option;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getOption(): int
    {
        return $this->option;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}