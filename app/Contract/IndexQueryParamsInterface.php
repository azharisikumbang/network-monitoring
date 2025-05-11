<?php

namespace App\Contract;

interface IndexQueryParamsInterface
{
    public function getSearch(): string;

    public function getLimit(): int;

}