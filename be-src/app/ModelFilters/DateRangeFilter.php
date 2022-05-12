<?php

namespace App\ModelFilters;

use App\ModelFilters\Base\FilterContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class DateRangeFilter implements FilterContract
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
            $filterValidationIdentifier       => 'required|min:2',
            "{$filterValidationIdentifier}.0" => "required|date|before_or_equal:{$filterValidationIdentifier}.1",
            "{$filterValidationIdentifier}.1" => 'required|date',
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toArray();
        }

        return [];
    }
}
