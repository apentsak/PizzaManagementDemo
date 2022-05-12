<?php

namespace App\ModelFilters\Base;

use App\Exceptions\FilterValidationException;
use Illuminate\Database\Eloquent\Builder;

interface FilterContract
{
    /**
     * Filter Validation is done by filterContract
     *
     * @throws FilterValidationException
     *
     * @return array of validation errors for filter value if empty - no errors
     */
    public function apply(Builder $builder, string $filterParam, array $filterValue): array;
}
