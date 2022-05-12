<script>
import ordersFiltersContainer from "@/modules/OrdersFiltersContainer";

export default {
  name: 'AdvancedFilters',

  data: () => {
    return {
        ordersFiltersContainer: ordersFiltersContainer,
        ordersFiltersList: ordersFiltersContainer.filters,
        selectedFilter: null,
        filtersList: [],
    };
  },

  computed: {
      currentForm: function () {
          return this.selectedFilter ? this.selectedFilter.formComponent : null;
      },

      currentFilter: function () {
        return this.selectedFilter;
      }
  },

  beforeMount() {
    let filtersList = [
      { value: null, text: 'Please select an filter' },
    ];

    for (let orderFilter in this.ordersFiltersList) {
        filtersList.push({
          value: this.ordersFiltersList[orderFilter],
          text: this.ordersFiltersList[orderFilter].title
        });
    }

    this.filtersList = filtersList;
  },

  methods: {
    addFilterValues: function (valueDTO) {
      if (!this.selectedFilter) return;

      let added = this.selectedFilter.addValue(valueDTO);
      if (!added) return;

      this.$emit('filterschanged', this.ordersFiltersContainer.getRequestParams());
    },
    removeFilterValues: function (filterKey, removeDTO) {
      let removed = this.ordersFiltersList[filterKey].removeValue(removeDTO);
      if (!removed) return;

      this.$emit('filterschanged', this.ordersFiltersContainer.getRequestParams());
    }
  }
}

</script>

<template>
  <section class="filters-container">
    <section class="row">
      <div class="col-md-4">
        <b-select id="filters-list" v-model="selectedFilter" :options="filtersList"></b-select>
      </div>
      <div class="col-md-8">
        <component
            @addvalue="addFilterValues"
            :filter="currentFilter"
            :is="currentForm"
        >
        </component>
      </div>
    </section>

    <section class="mb-1 mt-2">
        <component
            v-for="filter in ordersFiltersList"
            :key="filter.key"
            :value="ordersFiltersList[filter.key].values"
            :filterKey = "filter.key"
            :filterTitle = "filter.title"
            :is="filter.stateComponent"
            @itemremoved="removeFilterValues"
        >
        </component>
    </section>

  </section>
</template>

<style scoped>
  .filters-container {
      margin-top: 2em;
      margin-bottom: 1em;
      margin-left: 1em;
      margin-right: 1em;
  }
</style>
