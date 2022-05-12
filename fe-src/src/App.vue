<template>
  <div id="app">
    <b-container>
      <b-navbar toggleable="lg" type="dark" variant="primary">
        <b-navbar-brand href="#">Pizza list</b-navbar-brand>
      </b-navbar>

      <advanced-filters @filterschanged="updateOrdersList"></advanced-filters>
      <div class="text-center" v-if="loading">
        <b-spinner></b-spinner>
      </div>
      <order-list v-if="!loading" :orders="orders"></order-list>

    </b-container>
  </div>
</template>

<script>

import OrderList from "@/components/OrderList";
import AdvancedFilters from "@/components/AdvancedFilters";
import {fetchOrders} from "@/modules/OrdersFetcher";

export default {
  name: 'App',

  components: {
    AdvancedFilters,
    OrderList,
  },

  data: function () {
      return {
        orders: [],
        loading: true,
      };
  },

  beforeMount() {
    this.updateOrdersList();
  },

  methods: {
      updateOrdersList(filterParams) {
        this.loading = true;
        fetchOrders(filterParams)
            .then((response) => {
              this.orders.splice(0, this.orders.length);
              response.data.data.forEach((item) => {
                this.orders.push(item);
              });
              this.loading = false;

            }).catch((error) => {

            console.warn(error);
            this.loading = false;
        });
      }
  }
}
</script>
