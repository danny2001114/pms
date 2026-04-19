<script setup>
import {
  BButton,
  BTable,
  BRow,
  BCol
} from 'bootstrap-vue-next';

// ==== props ==== //
defineProps({
  fields: {
    type: Array,
    required: true,
  },
  list: {
    type: Array,
    default: []
  },
  showTotal: {
    type: Boolean,
    default: true
  },
  total: {
    type: Number,
    default: 0
  },
});

// ==== emiters ==== //
const emit = defineEmits([
  'onDestroy',
  'onEdit'
]);
</script>
<style>
.scrollable-table {
  max-height: 400px;
  overflow-y: auto;
}

.scrollable-table table {
  width: 100%;
  border-collapse: collapse;
}

.scrollable-table thead th {
  position: sticky;
  top: 0;
  background: #fff;
  z-index: 1;
  border-bottom: 2px solid #ccc;
}

.scrollable-table th,
td {
  padding: 8px;
  border-bottom: 1px solid #eee;
  text-align: left;
}
</style>
<template>
  <BRow class="mt-4">
    <BCol cols="2" class="fw-bold" v-if="showTotal">
      total - {{ total }}
    </BCol>
    <slot name="searchBar" />
  </BRow>
  <div class="scrollable-table mt-3">
    <BTable :items="list" :fields="fields" striped hover>
      <template #cell(serial)="data">
        {{ data.index + 1 }}
      </template>
      <template v-for="(_, name) in $slots" #[name]="slotProps">
        <slot :name="name" v-bind="slotProps" />
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
