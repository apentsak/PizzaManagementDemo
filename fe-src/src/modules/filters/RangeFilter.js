import RangeTypeFilterForm from "@/components/filters/forms/RangeTypeFilterForm";
import RangeTypeFilterState from "@/components/filters/states/RangeTypeFilterState";

export class RangeFilter {
    constructor() {
        this.title = "RangeDefaultFilter";
        this.key = "rangeDefaultListFilter";
        this.values = {
            from: null,
            to: null,
        };
        this.formComponent = RangeTypeFilterForm;
        this.stateComponent = RangeTypeFilterState;
    }

    addValue(valueDTO)
    {
        if (this.values.from === valueDTO.from
                && this.values.to === valueDTO.to ) {
            return false;
        }

        if (valueDTO.from === null
                || valueDTO.to === null) {
            return false;
        }

        this.values.from = valueDTO.from;
        this.values.to = valueDTO.to;

        return true;
    }

    removeValue()
    {
        this.values.from = null;
        this.values.to = null;

        return true;
    }

    prepareForRequest()
    {
        if (this.values.from === null) return  null;

        return `${this.key}:${this.values.from},${this.values.to}`;
    }
}