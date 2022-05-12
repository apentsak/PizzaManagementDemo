<template>
  <div class="row">
    <div class="col-md-5">
      <b-input id="filter-value" placeholder="from" v-model="from"></b-input>
    </div>
    <div class="col-md-5">
      <b-input id="filter-value-to" placeholder="to" v-model="to"></b-input>
    </div>
    <b-button class="col-md-2" v-on:click.stop.prevent="addValue" variant="primary">Add</b-button>
  </div>
</template>

<script>
export default {
  name: "RangeTypeFilterForm",

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
