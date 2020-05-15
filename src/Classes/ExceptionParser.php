<?php

declare(strict_types=1);

namespace Notifea\Classes;

use Notifea\Exceptions\NotifeaException;
use Psr\Http\Message\ResponseInterface;

class ExceptionParser
{
    public static function parse(ResponseInterface $response)
    {
        $data = self::getResponseData($response);
        $message = $data->data->message;
        $code = $data->code;

        return new NotifeaException($message, $response->getStatusCode(), $code);
    }

    protected static function getResponseData(ResponseInterface $response)
    {
        $response->getBody()->rewind();

        return json_decode($response->getBody()->getContents());
    }
}
