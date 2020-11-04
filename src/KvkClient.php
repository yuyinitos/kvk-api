<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi;

use Yuyinitos\KvkApi\Client\Factory\KvkPaginatorFactoryInterface;
use Yuyinitos\KvkApi\Client\KvkPaginatorInterface;
use Yuyinitos\KvkApi\Exception\KvkApiException;
use Yuyinitos\KvkApi\Http\ClientInterface;
use Yuyinitos\KvkApi\Http\Endpoint\MapperInterface;
use Yuyinitos\KvkApi\Http\Search\QueryInterface;

final class KvkClient implements KvkClientInterface, KvkPaginatorAwareInterface
{
    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var KvkPaginatorFactoryInterface
     */
    private $profileResponseFactory;

    public function __construct(ClientInterface $httpClient, KvkPaginatorFactoryInterface $profileResponseFactory)
    {
        $this->httpClient = $httpClient;
        $this->profileResponseFactory = $profileResponseFactory;
    }

    public function getProfile(QueryInterface $profileQuery): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::PROFILE, $profileQuery));
        $data = $this->decodeJsonToArray($json);

        return $this->profileResponseFactory->fromProfileData($data);
    }

    /**
     * Execute search query
     * @author Patrick Development <info@patrickdevelopment.nl>
     */
    public function fetchSearch(QueryInterface $profileQuery): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getEndpoint(MapperInterface::SEARCH, $profileQuery));
        $data = $this->decodeJsonToArray($json);

        return $this->profileResponseFactory->fromProfileData($data);
    }

    public function getNextPage(KvkPaginatorInterface $kvkPaginator): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getUrl($kvkPaginator->getNextUrl()));
        $data = $this->decodeJsonToArray($json);

        return $this->profileResponseFactory->fromProfileData($data);
    }

    public function getPreviousPage(KvkPaginatorInterface $kvkPaginator): KvkPaginatorInterface
    {
        $json = $this->httpClient->getJson($this->httpClient->getUrl($kvkPaginator->getPreviousUrl()));
        $data = $this->decodeJsonToArray($json);

        return $this->profileResponseFactory->fromProfileData($data);
    }

    private function decodeJsonToArray(string $json): array
    {
        $jsonPayload = json_decode($json, true);

        if (!isset($jsonPayload['data']) && !isset($jsonPayload['error'])) {
            throw new KvkApiException(
                "Unknown payload: \n"
                . $json
            );
        }

        if (!isset($jsonPayload['data'])) {
            throw new KvkApiException(
                $jsonPayload['error']['message'] . ': ' . $jsonPayload['error']['reason'],
                $jsonPayload['error']['code']
            );
        }

        return $jsonPayload['data'];
    }
}
