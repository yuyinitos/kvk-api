<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Client\Factory\Profile\Company;

use Yuyinitos\KvkApi\Client\Factory\AbstractFactory;
use Yuyinitos\KvkApi\Client\Profile\Company\TradeNames;

final class TradeNamesFactory extends AbstractFactory implements TradeNamesFactoryInterface
{
    public function fromArray(array $data): TradeNames
    {
        return new TradeNames(
            $this->extractStringOrNull('businessName', $data),
            $this->extractStringOrNull('shortBusinessName', $data),
            $this->extractArrayOrNull('currentTradeNames', $data),
            $this->extractArrayOrNull('currentStatutoryNames', $data)
        );
    }
}
