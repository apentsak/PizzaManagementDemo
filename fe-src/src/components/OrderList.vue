<script>

let statusToVariantMap = {
  delivered: 'success',
  called: 'warning',
  cancelled: 'secondary',
  ordered: 'danger',
};

export default {
  name: 'OrderList',

  props: {
    orders: Array
  },

  data: function () {

    return {
      fields: [
        {
          key: 'id',
          label: 'id',
        },
        {
          key:  'user',
          label:  'Client',
        },
        'city',
        'street',
        'building',
        'apartment',
        {
          key: 'status',
          formatter: (value) => {
            return {
              variant: statusToVariantMap[value],
              status: value
            };
          },
        },
        {
          key: 'date',
          label: 'Order date',
        },
        {
          key: 'paidInAdvance',
          label: 'Payment',
          formatter: (value) => {
            return {
              variant: value ? 'success' : 'secondary',
              status: value ? 'paid' : 'on delivery',
            };
          }
        },
        {
          key: 'totalPrice',
          label: '$',
        }
      ]
    };
  },
}
</script>

<template>
  <b-table striped
           hover
           light
           :items="orders"
           :fields="fields">

    <template #cell(id)="data">
      {{ data.value }}
    </template>

    <template #cell(city)="data">
      <b-badge variant="warning">{{ data.value.toUpperCase() }}</b-badge>
    </template>

    <template #cell(date)="data">
      <b>{{ data.value ? data.value.toLocaleString('en-GB') : '-' }}</b>
    </template>

    <template #cell(user)="data">
      <b>{{ data.value.lastName.toUpperCase() }}</b>, {{ data.value.firstName }}
    </template>

    <template #cell(status)="data">
      <b-badge :variant=data.value.variant>{{ data.value.status }}</b-badge>
    </template>

    <template #cell(paidInAdvance)="data">
      <b-badge :variant=data.value.variant>{{ data.value.status }}</b-badge>
    </template>

    <template #cell(totalPrice)="data">
        {{ data.value }}$
    </template>

  </b-table>
</template>
