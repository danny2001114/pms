<script setup>
import {
  BTable,
  BButton
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  users: Array
});

const fields = [
  { key: 'serial', label: 'No.' },
  { key: 'code', label: 'Code' },
  { key: 'name', label: 'Name' },
  { key: 'email', label: 'Email' },
  { key: 'phone', label: 'Phone' },
  { key: 'role_text', label: 'Role' },
  { key: 'actions', label: 'Actions' }
];
</script>
<template>
  <div class="d-flex align-items-center">
    <h3>User List</h3>
    <BButton class="ms-auto" variant="primary" @click="router.visit(route('user.create'))">
      Add
    </BButton>
  </div>
  <hr>

  <BTable :items="users" :fields="fields" striped hover>
    <template #cell(serial)="data">
      {{ data.index + 1 }}
    </template>
    <template #cell(actions)="data">
      <BButton variant="primary" size="sm" class="me-1" @click="router.visit(route('user.show', data.item.id))">
        Detail
      </BButton>
      <template v-if="data.item.role !== 4">
        <BButton variant="warning" size="sm" class="me-1" @click="router.visit(route('user.edit', data.item.id))">
          Edit
        </BButton>
        <BButton variant="danger" size="sm" @click="router.delete(route('user.destroy', data.item.id))">
          Delete
        </BButton>
      </template>
    </template>
  </BTable>
</template>
