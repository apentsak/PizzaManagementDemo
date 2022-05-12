<?php

namespace App\ModelFilters;

use App\ModelFilters\Base\FilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class RangeFilter implements FilterContract
{
    public function apply(Builder $builder, string $filterParam, array $filterValue): array
    {
        $errors = $this->validateFilterValue($filterParam, $filterValue);

        if (empty($errors)) {
            $builder->where($filterParam, '>=', $filterValue[0])
                ->where($filterParam, '<=', $filterValue[1]);
        }

        return $errors;
    }

    protected function validateFilterValue(string $filterParam, array $filterValue): array
    {
        $filterValidationIdentifier = "range_{$filterParam}";

        $validator = Validator::make([
            $filterValidationIdentifier => $filterValue,
        ], [
            $filterValidationIdentifier       => 'required|array|min:2',
            "{$filterValidationIdentifier}.0" => 'required|numeric',
            "{$filterValidationIdentifier}.1" => "required|numeric|gte:{$filterValidationIdentifier}.0",
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toArray();
        }

        return [];
    }
}
