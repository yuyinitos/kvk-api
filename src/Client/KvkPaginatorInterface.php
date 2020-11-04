<?php

namespace Yuyinitos\KvkApi\Client;

interface KvkPaginatorInterface
{
    public function getNextUrl(): ?string;

    public function getPreviousUrl(): ?string;
}
