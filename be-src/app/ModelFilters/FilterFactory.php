<?php

namespace App\ModelFilters;

use App\ModelFilters\Base\FilterContract;
use Exception;

class FilterFactory
{
    private array $filterToClassMap = [
        'list'      => ListFilter::class,
        'range'     => RangeFilter::class,
        'dateRange' => DateRangeFilter::class,
    ];

    /** @throws Exception */
    public function create(string $filterName): FilterContract
    {
        if (isset($this->filterToClassMap[$filterName])) {

            if (!($this->filterToClassMap[$filterName] instanceof FilterContract)) {
                $this->filterToClassMap[$filterName] = resolve($this->filterToClassMap[$filterName]);
            }

            return $this->filterToClassMap[$filterName];
        }

        throw new Exception("Unknown filter {$filterName}");
    }
}
