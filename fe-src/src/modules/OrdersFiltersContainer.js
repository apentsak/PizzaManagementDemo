import {FiltersFactory} from "@/modules/FiltersFactory";

class OrdersFiltersContainer {

    constructor() {

        let factory = new FiltersFactory();

        let city = factory.initCitiesFilter();
        let street = factory.initStreetsFilter();
        let status = factory.initStatusFilter();
        let priceRange = factory.initPriceRangeFilter();
        let dateRange = factory.initDateRangeFilter();

        this.filters = {};
        this.filters[city.key] = city;
        this.filters[street.key] = street;
        this.filters[status.key] = status;
        this.filters[priceRange.key] = priceRange;
        this.filters[dateRange.key] = dateRange;
    }

    getRequestParams()
    {
        let request = [];
        let params;

        for (let filterKey in this.filters) {
            params = this.filters[filterKey].prepareForRequest();
            if (params === null) continue;
            request.push(params);
        }

        return request.length ? request.join(';') : null;
    }
}

let ordersFiltersContainer = new OrdersFiltersContainer();

export default ordersFiltersContainer;