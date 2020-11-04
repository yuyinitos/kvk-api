<?php

namespace Yuyinitos\KvkApi\Client\Factory\Profile;

use Yuyinitos\KvkApi\Client\Profile\Company;

interface CompanyFactoryInterface
{
    public function fromArray(array $data): Company;
}
