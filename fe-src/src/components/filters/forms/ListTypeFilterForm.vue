<template>
  <div class="row">
    <div class="col-md-10">
      <b-select id="filter-value" v-model="selectedOption" :options="options"></b-select>
    </div>
      <b-button class="col-md-2" v-on:click.stop.prevent="addValue" variant="primary">Add</b-button>
  </div>
</template>

<script>
export default {
  name: "ListTypeFilterForm",

  props: {
    filter: Object,
  },

  data: function () {
    return {
      selectedOption: null,
    }
  },

  computed: {
      options: function () {
        let options = [
          { value: null, text: 'Please select an option', disabled: true }
        ];

        this.filter.options.forEach(function (value) {
          options.push({ value: value, text: value.title });
        });

        return  options;
      }
  },

  methods: {
    addValue: function ()  {
      if (this.selectedOption === null) return;

      this.$emit('addvalue', this.selectedOption);
    }
  },
}
</script>
