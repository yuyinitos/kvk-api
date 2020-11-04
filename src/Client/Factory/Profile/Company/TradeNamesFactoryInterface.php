<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Client\Factory\Profile\Company;

use Yuyinitos\KvkApi\Client\Profile\Company\TradeNames;

interface TradeNamesFactoryInterface
{
    public function fromArray(array $data): TradeNames;
}
