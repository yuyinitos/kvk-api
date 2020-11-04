<?php

declare(strict_types=1);

namespace Yuyinitos\KvkApi\Http\Endpoint;

interface MapperInterface
{
    public const PROFILE = 'profile';
    public const SEARCH = 'search';

    public function map(string $key): string;
}
