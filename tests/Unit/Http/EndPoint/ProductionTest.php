<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Test\Unit\Http\Endpoint;

use PHPUnit\Framework\TestCase;
use Yuyinitos\KvkApi\Http\Endpoint\MapperInterface;
use Yuyinitos\KvkApi\Http\Endpoint\Production;

/**
 * @small
 *
 * @internal
 */
final class ProductionTest extends TestCase
{
    /**
     * @test
     * @dataProvider getEndpoints
     */
    public function can_map_all_keys(string $endpointKey): void
    {
        $endpoint = new Production();
        $endpoint = $endpoint->map($endpointKey);

        self::assertNotNull($endpoint);
        self::assertContains(Production::BASE_URL, $endpoint);
    }

    /**
     * @test
     * @expectedException \Yuyinitos\KvkApi\Http\Endpoint\Exception\EndpointCouldNotBeMappedException
     */
    public function mapping_invalid_key_throws_exception(): void
    {
        $endpoint = new Production();
        $endpoint->map('invalid');
    }

    public function getEndpoints(): array
    {
        return [
            MapperInterface::PROFILE => [MapperInterface::PROFILE],
            MapperInterface::SEARCH => [MapperInterface::SEARCH],
        ];
    }
}
