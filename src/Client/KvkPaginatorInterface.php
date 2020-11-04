<?php

namespace Yuyinitos\KvkApi\Client;

interface KvkPaginatorInterface
{
    public function getNextUrl(): ?string;

    public function getPreviousUrl(): ?string;

    public function getItems(): array;

    public function getTotalItems(): int;

    public function getItemsPerPage(): int;
}
