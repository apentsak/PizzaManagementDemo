import {ListFilter} from "@/modules/filters/ListFilter";
import {RangeFilter} from "@/modules/filters/RangeFilter";
import DateRangeTypeFilterForm from "@/components/filters/forms/DateRangeTypeFilterForm";

export class FiltersFactory {

    initCitiesFilter() {
        let filter = new ListFilter();
        filter.title = 'Cities';
        filter.key = 'city';
        filter.options = [
            {key: "Lviv", title: "Lviv"},
            {key: "Kyiv", title: "Kyiv"},
            {key: "Dnipro", title: "Dnipro"},
            {key: "Kharkiv", title: "Kharkiv"},
            {key: "Poltava", title: "Poltava"},
        ];
        return filter;
    }

    initStreetsFilter() {
        let filter = new ListFilter();
        filter.title = "Streets";
        filter.key = 'street';
        filter.options = [
            {key: "Shevchenko", title: "Shevchenko"},
            {key: "Heroiv Krut", title: "Heroiv Krut"},
            {key: "Mazepa", title: "Mazepa"},
            {key: "Bandera", title: "Bandera"},
            {key: "Khmel", title: "Khmel"},
            {key: "Ukrainka", title: "Ukrainka"},
        ];
        return filter;
    }

    initStatusFilter() {
        let filter = new ListFilter();
        filter.title = "Statuses";
        filter.key = 'status';
        filter.options = [
            {key: "ordered", title: "Ordered"},
            {key: "called", title: "Called"},
            {key: "delivered", title: "Delivered"},
            {key: "cancelled", title: "Cancelled"},
        ];
        return filter;
    }

    initPriceRangeFilter() {
        let filter = new RangeFilter();
        filter.title = "Price range";
        filter.key = 'totalPrice';

        return filter;
    }

    initDateRangeFilter() {
        let filter = new RangeFilter();
        filter.title = "Date range";
        filter.key = 'date';
        filter.formComponent = DateRangeTypeFilterForm;

        return filter;
    }
}