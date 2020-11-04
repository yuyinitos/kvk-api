<?php

namespace Yuyinitos\KvkApi\Client\Factory\Profile\Company;

use Yuyinitos\KvkApi\Client\Profile\Company\BusinessActivity;

interface BusinessActivityFactoryInterface
{
    /**
     * @return BusinessActivity[]
     */
    public function fromArray(array $data): array;
}
