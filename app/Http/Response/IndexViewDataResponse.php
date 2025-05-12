<?php

namespace App\Http\Response;

use App\Contract\IndexViewDataInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexViewDataResponse implements IndexViewDataInterface
{
    const QUERY_SEARCH = "search";
    const QUERY_LIMIT = 'limit';

    public function __construct(
        private readonly LengthAwarePaginator $data,
        private readonly Request $request
    ) {
    }

    public function getData(): LengthAwarePaginator
    {
        return $this->data;
    }

    public function getSearch(): string
    {
        return $this->request->get(self::QUERY_SEARCH) ?? '';
    }
    public function getLimit(): int
    {
        return $this->request->get(self::QUERY_LIMIT) ?? 10;
    }

    public function toArray(): array
    {
        return [
            'data' => $this->getData()->toArray(),
            'params' => [
                'search' => $this->getSearch(),
                'limit' => $this->getLimit()
            ],
            'flash' => [
                'success' => $this->request->session()->get('success') ?? null
            ]
        ];
    }
}