<?php

namespace Mar3q\HttpClient\Handler;

use CurlHandle;
use Mar3q\HttpClient\Exception\ClientException;
use Mar3q\HttpClient\Request\Request;
use Mar3q\HttpClient\Response\Builder;
use Mar3q\HttpClient\Response\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CurlHandler
{
    /** @var CurlHandle */
    private CurlHandle $curlHandle;

    /**
     * @var mixed
     */
    private $curlResult;

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        $this->curlHandle = curl_init($request->getUri());

        curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curlHandle, CURLOPT_HEADER, 1);

        foreach($request->getConfig()->getCurlOptions() as $item) {
            curl_setopt($this->curlHandle, $item->getOption(), $item->getValue());
        }

        if($request->isPost()) {
            curl_setopt($this->curlHandle, CURLOPT_POST, 1);
        }

        if($request->isPut()) {
            curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, "PUT");
        }

        if($request->isDelete()) {
            curl_setopt($this->curlHandle, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        if($payload = $request->getPayload()) {
            curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, $payload);
        }


        if($request->getConfig()->hasHeaders()) {
            curl_setopt($this->curlHandle, CURLOPT_HTTPHEADER, $request->getConfig()->getHeadersAsString());
        }


        $this->curlResult = curl_exec($this->curlHandle);

        $response = Builder::build($this->curlHandle, $this->curlResult);

        $error = "";
        if(curl_errno($this->curlHandle)) {
            $error = curl_error($this->curlHandle);
        }

        curl_close($this->curlHandle);

        if(!empty($error)) {
            throw new ClientException($error);
        }

        return $response;
    }
}