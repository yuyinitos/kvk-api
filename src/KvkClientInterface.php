<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi;

use Yuyinitos\KvkApi\Client\KvkPaginatorInterface;
use Yuyinitos\KvkApi\Http\Search\QueryInterface;

interface KvkClientInterface
{
    public function getProfile(QueryInterface $profileQuery): KvkPaginatorInterface;
}
