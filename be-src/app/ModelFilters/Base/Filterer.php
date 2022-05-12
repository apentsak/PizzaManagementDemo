<?php

namespace App\ModelFilters\Base;

use App\Exceptions\FilterValidationException;
use App\ModelFilters\FilterFactory;
use Illuminate\Database\Eloquent\Builder;
use Exception;
use Illuminate\Support\Str;

class Filterer
{
    public function __construct(
        protected FilterFactory $filterFactory
    ) {}

    /**
     * @throws FilterValidationException
     * @throws Exception
     */
    public function apply(Builder $query, array $filterNamesToFiltersMap, string $filtersSetup = ''): Builder
    {
        $validationErrors = [];
        $filterNamesToValuesMap = $this->parseFiltersSetup($filtersSetup);

        foreach ($filterNamesToFiltersMap as $allowedFilterParam => $filter) {
            //no filter -> ignore
            if (empty($filterNamesToFiltersMap[$allowedFilterParam])) continue;
            //no value for filter -> ignore
            if (empty($filterNamesToValuesMap[$allowedFilterParam])) continue;

            $filterValue = $filterNamesToValuesMap[$allowedFilterParam];
            $filter = $this->initFilter($filter);
            $errors = $filter->apply($query, $allowedFilterParam, $filterValue);

            if (!empty($errors)) {
                $validationErrors = array_merge($validationErrors, $errors);
            }
        }

        if (!empty($validationErrors)) {
            throw new FilterValidationException($validationErrors, "Filters aren't configured properly");
        }

        return $query;
    }

    private function parseFiltersSetup(string $filtersSetupString): array
    {
        $filters = [];
        $filterGroups = explode(';', $filtersSetupString);

        foreach ($filterGroups as $filterGroup) {
            $filter = explode(':', $filterGroup);
            if (Str::startsWith($filter[0], '$')) { //combine in one group
                $filterName = ltrim($filter[0],'$');
                $filters[$filterName][] = !empty($filter[1]) ? explode(',', $filter[1]) : [];
                continue;
            }
            $filters[$filter[0]] = !empty($filter[1]) ? explode(',', $filter[1]) : [];
        }

        return $filters;
    }

    /** @throws Exception */
    private function initFilter(string|FilterContract $filter): FilterContract
    {
        if (is_string($filter)) {
            return $this->filterFactory->create($filter);
        }

        return $filter;
    }
}
