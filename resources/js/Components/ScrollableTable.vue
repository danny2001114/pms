<script setup>
import {
  BButton,
  BTable,
  BRow,
  BCol
} from 'bootstrap-vue-next';

defineProps({
  list: Array,
  total: Number,
  form: Object,
  fields: Array,
});

const emit = defineEmits([
  'onDestroy',
  'onEdit'
]);
</script>

<template>
  <BRow class="mt-4">
    <BCol cols="2" class="fw-bold">total - {{ total }}</BCol>
    <slot name="searchBar"></slot>
  </BRow>
  <div class="scrollable-table mt-3">
    <BTable :items="list" :fields="fields" striped hover>
      <template #cell(serial)="data">
        {{ data.index + 1 }}
      </template>
      <template #cell(active)="data">
        {{ Boolean(data.item.active) ? "true" : "false" }}
      </template>
      <template #cell(actions)="data">
        <BButton variant="warning" size="sm" class="me-1" @click="emit('onEdit', data.item)">
          Edit
        </BButton>
        <BButton variant="danger" size="sm" @click="emit('onDestroy', data.item.id)">
          Delete
        </BButton>
      </template>
    </BTable>
  </div>
</template>
