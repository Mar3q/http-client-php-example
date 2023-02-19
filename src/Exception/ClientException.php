<?php

namespace Mar3q\HttpClient\Exception;

class ClientException extends \RuntimeException
{

    /**
     * @param \Throwable $throwable
     *
     * @return ClientException
     */
    public static function fromThrowable(\Throwable $throwable): self
    {
        return new self($throwable->getMessage(), (int)$throwable->getCode(), $throwable);
    }
}