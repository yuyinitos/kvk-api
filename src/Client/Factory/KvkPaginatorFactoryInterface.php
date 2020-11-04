<?php

namespace Yuyinitos\KvkApi\Client\Factory;

use Yuyinitos\KvkApi\Client\KvkPaginatorInterface;

interface KvkPaginatorFactoryInterface
{
    public function fromProfileData(array $data): KvkPaginatorInterface;
}
