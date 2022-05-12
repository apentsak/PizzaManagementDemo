<template>
    <div v-if="value.from">
      <label class="mr-2 text-info">{{ filterTitle }}</label>
      <b-badge variant="warning">
        {{ value.from }} {{ value.to ? `- ${value.to}`: ''  }} <b-icon-x class="remove-btn" @click="removeItem"></b-icon-x>
      </b-badge>
    </div>
</template>

<script>
export default {
  name: "RangeTypeFilterState",
  props: {
    value: Object,
    filterTitle: String,
    filterKey: String
  },

  methods: {
    removeItem: function () {
      this.$emit("itemremoved", this.filterKey, {});
    }
  }
}
</script>

<style scoped>
  .remove-btn {
    cursor: pointer;
  }
</style>
