<template>
    <div v-if="value.length">
      <label class="mr-2 text-info">{{ filterTitle }}</label>
      <b-badge
          v-for="(val, index) in value"
          :key="index"
          class="mr-2"
          variant="info">
        {{ val.title }} <b-icon-x class="remove-btn" @click="removeItem(index)"></b-icon-x>
      </b-badge>
    </div>
</template>

<script>
export default {
  name: "ListTypeFilterState",
  props: {
    value: Array,
    filterTitle: String,
    filterKey: String
  },
  methods: {
    removeItem: function (itemIndex) {
        this.$emit("itemremoved", this.filterKey, { index : itemIndex});
    }
  }
}
</script>

<style scoped>
  .remove-btn {
    cursor: pointer;
  }
</style>
