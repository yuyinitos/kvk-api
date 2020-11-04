<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Client\Factory;

use Yuyinitos\KvkApi\Client\Factory\Profile\CompanyFactoryInterface;
use Yuyinitos\KvkApi\Client\KvkPaginator;
use Yuyinitos\KvkApi\Client\KvkPaginatorInterface;
use Yuyinitos\KvkApi\Client\Profile\Company;

final class KvkPaginatorFactory extends AbstractFactory implements KvkPaginatorFactoryInterface
{
    /**
     * @var CompanyFactoryInterface
     */
    private $companyFactory;

    public function __construct(CompanyFactoryInterface $companyFactory)
    {
        $this->companyFactory = $companyFactory;
    }

    public function fromProfileData(array $data): KvkPaginatorInterface
    {
        return new KvkPaginator(
            $this->extractIntegerOrNull('itemsPerPage', $data),
            $this->extractIntegerOrNull('startPage', $data),
            $this->extractIntegerOrNull('totalItems', $data),
            $this->extractCompanies($data['items']),
            $this->extractStringOrNull('nextLink', $data),
            $this->extractStringOrNull('previousLink', $data)
        );
    }

    /**
     * @return Company[]
     */
    private function extractCompanies(array $data): array
    {
        $companies = [];

        foreach ($data  as $company) {
            $companies[] = $this->companyFactory->fromArray($company);
        }

        return $companies;
    }
}
