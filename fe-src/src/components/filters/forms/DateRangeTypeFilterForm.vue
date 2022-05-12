<template>
  <div class="row">
    <div class="col-md-5">
      <b-form-datepicker id="filter-value" class="mb-2" v-model="from"></b-form-datepicker>
    </div>
    <div class="col-md-5">
      <b-form-datepicker id="filter-value-to" class="mb-2" v-model="to"></b-form-datepicker>
    </div>
    <b-button class="col-md-2" v-on:click.stop.prevent="addValue" variant="primary">Add</b-button>
  </div>
</template>

<script>
export default {
  name: "DateRangeTypeFilterForm",

  props: {
    filter: Object,
  },

  data: () => {
    return {
      from: null,
      to: null,
    }
  },

  methods: {
    addValue: function ()  {
      let range = { from: this.from, to: this.to };
      this.$emit('addvalue', range);
    }
  },
}
</script>
