import ListTypeFilterState from "@/components/filters/states/ListTypeFilterState";
import ListTypeFilterForm from "@/components/filters/forms/ListTypeFilterForm";

export class ListFilter {
    constructor() {
        this.title = "DefaultListFilter";
        this.key = "defaultListFilter";
        this.values = [];
        this.options = [];
        this.formComponent = ListTypeFilterForm;
        this.stateComponent = ListTypeFilterState;
    }

    addValue(valueDTO)
    {
        if (valueDTO.key === null) return false;
        if (this._isInList(valueDTO)) return false;

        this.values.push(valueDTO);
        return true;
    }

    removeValue(removeDTO)
    {
        if (removeDTO.index > this.values.length) return false;

        this.values.splice(removeDTO.index, 1);
        return true;
    }

    prepareForRequest()
    {
        if (this.values.length === 0) return  null;

        let keys = [];

        this.values.forEach(function (value) {
            keys.push(value.key);
        });

        return `${this.key}:${keys.join(',')}`;
    }

    _isInList(valueDTO)
    {
        for (let i = 0; i < this.values.length; i++)
        {
            if (this.values[i].key === valueDTO.key) {
                return true;
            }
        }

        return false;
    }
}