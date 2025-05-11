<?php

namespace App\Contract;

use Illuminate\Pagination\LengthAwarePaginator;

interface IndexViewDataInterface extends IndexQueryParamsInterface
{
    public function getData(): LengthAwarePaginator;

    public function toArray(): array;

}