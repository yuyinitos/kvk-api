<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi;

use Yuyinitos\KvkApi\Client\KvkPaginatorInterface;

interface KvkPaginatorAwareInterface
{
    public function getNextPage(KvkPaginatorInterface $kvkPaginator): KvkPaginatorInterface;

    public function getPreviousPage(KvkPaginatorInterface $kvkPaginator): KvkPaginatorInterface;
}
