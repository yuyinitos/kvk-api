<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Test\Unit\Http\Adapter\Guzzle\Exception;

use GuzzleHttp\Exception\RequestException;
use Mockery;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Yuyinitos\KvkApi\Http\Adapter\Guzzle\Exception\Handler;

/**
 * @small
 *
 * @internal
 */
final class HandlerTest extends TestCase
{
    /**
     * @test
     * @expectedException \Yuyinitos\KvkApi\Exception\KvkApiException
     */
    public function handle_request_exception_should_throw_generic_exception(): void
    {
        Handler::handleRequestException($this->getException());
    }

    /**
     * @test
     * @expectedException \Yuyinitos\KvkApi\Http\Adapter\Guzzle\Exception\NotFoundException
     */
    public function handle_request_exception_should_throw_not_found_exception(): void
    {
        Handler::handleRequestException($this->getException(404));
    }

    private function getException(?int $code = 400): RequestException
    {
        $response = Mockery::mock(ResponseInterface::class);
        $response->shouldReceive('getStatusCode')->andReturn($code);

        return new RequestException('', Mockery::mock(RequestInterface::class), $response);
    }
}
