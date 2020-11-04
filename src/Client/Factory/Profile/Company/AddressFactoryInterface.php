<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Client\Factory\Profile\Company;

use Yuyinitos\KvkApi\Client\Profile\Company\Address;

interface AddressFactoryInterface
{
    /**
     * @return Address[]
     */
    public function fromArray(array $data): array;
}
