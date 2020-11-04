<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Client;

use Yuyinitos\KvkApi\Client\Exception\PageDoesNotExistException;
use Yuyinitos\KvkApi\Client\Profile\Company as ProfileCompany;

final class KvkPaginator implements KvkPaginatorInterface
{
    private $itemsPerPage;

    private $startPage;

    private $totalItems;

    private $items;

    private $nextUrl;

    private $previousUrl;

    public function __construct(
        int $itemsPerPage,
        int $startPage,
        int $totalItems,
        array $items,
        ?string $nextLink = null,
        ?string $previousLink = null
    ) {
        $this->itemsPerPage = $itemsPerPage;
        $this->startPage = $startPage;
        $this->totalItems = $totalItems;
        $this->items = $items;
        $this->nextUrl = $nextLink;
        $this->previousUrl = $previousLink;
    }

    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function getStartPage(): int
    {
        return $this->startPage;
    }

    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @return ProfileCompany[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function getNextUrl(): string
    {
        if (!$this->nextUrl) {
            throw new PageDoesNotExistException();
        }

        return $this->nextUrl;
    }

    public function getPreviousUrl(): string
    {
        if (!$this->previousUrl) {
            throw new PageDoesNotExistException();
        }

        return $this->previousUrl;
    }
}
