<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Http\Adapter\Guzzle\Exception;

use GuzzleHttp\Exception\RequestException;
use Yuyinitos\KvkApi\Exception\KvkApiException;

final class Handler
{
    public static function handleRequestException(RequestException $exception): void
    {
        switch ($exception->getCode()) {
            case 404:
                throw new NotFoundException();
        }

        throw new KvkApiException($exception->getMessage());
    }
}
