<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi;

use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Yuyinitos\KvkApi\Client\Factory\KvkPaginatorFactory;
use Yuyinitos\KvkApi\Client\Factory\Profile\Company\AddressFactory;
use Yuyinitos\KvkApi\Client\Factory\Profile\Company\BusinessActivityFactory;
use Yuyinitos\KvkApi\Client\Factory\Profile\Company\TradeNamesFactory;
use Yuyinitos\KvkApi\Client\Factory\Profile\CompanyFactory;
use Yuyinitos\KvkApi\Http\Adapter\Guzzle\Client as GuzzleClient;
use Yuyinitos\KvkApi\Http\ClientInterface;
use Yuyinitos\KvkApi\Http\Endpoint\MapperInterface;

final class KvkClientFactory
{
    public static function create(string $userKey, MapperInterface $endpoint): KvkClient
    {
        return new KvkClient(
            self::createHttpClient($userKey, $endpoint),
            self::createProfileResponseFactory()
        );
    }

    private static function createHttpClient(string $userKey, MapperInterface $endpoint): ClientInterface
    {
        $stack = HandlerStack::create();
        $stack->unshift(Middleware::mapRequest(function (RequestInterface $request) use ($userKey) {
            return $request->withUri(Uri::withQueryValue($request->getUri(), 'user_key', $userKey));
        }));

        return new GuzzleClient(
            new \GuzzleHttp\Client(['handler' => $stack]),
            $endpoint
        );
    }

    private static function createProfileResponseFactory(): KvkPaginatorFactory
    {
        return new KvkPaginatorFactory(
            new CompanyFactory(
                new TradeNamesFactory(),
                new BusinessActivityFactory(),
                new AddressFactory()
            )
        );
    }
}
