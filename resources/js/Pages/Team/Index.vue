<script setup>
import {
  BTable, 
  BButton 
} from 'bootstrap-vue-next';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  teams: Object
});

const fields = [
  { key: 'serial', label: 'No.' },
  { key: 'name', label: 'Name' },
  { key: 'leader', label: 'Leader' },
  { key: 'total_members', label: 'Members' },
  { key: 'actions', label: 'Actions' }
];
</script>
<template>
  <div class="d-flex align-items-center">
    <h3>Team List</h3>
    <BButton class="ms-auto" size="sm" variant="primary" @click="router.visit(route('team.create'))">
      Add
    </BButton>
  </div>
  <hr>

  <BTable :items="teams.data" :fields="fields" striped hover>
    <template #cell(serial)="data">
      {{ data.index + 1 }}
    </template>
    <template #cell(leader)="data">
      {{ data.item.leader.name }}
    </template>
        <template #cell(total_members)="data">
      {{ data.item.members_count }}
    </template>
    <template #cell(actions)="data">
      <BButton variant="primary" size="sm" class="me-1" @click="router.visit(route('team.show', data.item.id))">
        Detail
      </BButton>
      <BButton variant="warning" size="sm" class="me-1" @click="router.visit(route('team.edit', data.item.id))">
        Edit
      </BButton>
      <BButton variant="danger" size="sm" @click="router.delete(route('team.destroy', data.item.id))">
        Delete
      </BButton>
    </template>
  </BTable>
</template>
