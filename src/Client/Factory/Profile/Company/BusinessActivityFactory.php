<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Client\Factory\Profile\Company;

use Yuyinitos\KvkApi\Client\Factory\AbstractFactory;
use Yuyinitos\KvkApi\Client\Profile\Company\BusinessActivity;

final class BusinessActivityFactory extends AbstractFactory implements BusinessActivityFactoryInterface
{
    /**
     * @return BusinessActivity[]
     */
    public function fromArray(array $data): array
    {
        $businessActivities = [];
        foreach ($data as $businessActivity) {
            $businessActivities[] = $this->buildFromArray($businessActivity);
        }

        return $businessActivities;
    }

    private function buildFromArray(array $data): BusinessActivity
    {
        return new BusinessActivity(
            $this->extractIntegerOrNull('sbiCode', $data),
            $this->extractStringOrNull('sbiCodeDescription', $data),
            $this->extractBoolean('isMainSbi', $data)
        );
    }
}
