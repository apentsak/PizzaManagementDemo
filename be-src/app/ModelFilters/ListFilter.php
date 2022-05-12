<?php

namespace App\ModelFilters;

use App\ModelFilters\Base\FilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class ListFilter implements FilterContract
{
    public function apply(Builder $builder, string $filterParam, array $filterValue): array
    {
        $errors = $this->validateFilterValue($filterParam, $filterValue);

        if (empty($errors)) {
            $builder->whereIn($filterParam, $filterValue);
        }

        return $errors;
    }

    protected function validateFilterValue(string $filterParam, array $filterValue): array
    {
        $filterValidationIdentifier = "list_{$filterParam}";

        $validator = Validator::make([
            $filterValidationIdentifier => $filterValue,
        ], [
            $filterValidationIdentifier       => 'array',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toArray();
        }

        return [];
    }
}
