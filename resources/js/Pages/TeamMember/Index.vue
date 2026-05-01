<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { 
  BButton,
  BInputGroup,
  BFormInput,
  BTable
} from 'bootstrap-vue-next';

const props = defineProps({
  teamId: Number,
  members: Array
});

const form = useForm({
  code: ''
});

const fields = [
  { key: 'serial', label: '.No' },
  { key: 'name', label: 'Name' },
  { key: 'code', label: 'Code' },
  { key: 'actions', label: 'Actions' }
];
</script>
<template>
  <div class="mt-4 row">
    <div class="ms-auto col-3">
      <BInputGroup>
        <BFormInput type="text" id="code" placeholder="Enter User Code ..." v-model="form.code" />
        <template #append>
          <BButton variant="primary" @click="form.post(route('team.member.store', teamId))">Add</BButton>
        </template>
      </BInputGroup>
      <div class="text-danger" v-if="form.errors.code">{{ form.errors.code }}</div>
    </div>
  </div>
  <div class="scrollable-table mt-3">
    <BTable :items="members" :fields="fields" striped hover>
      <template #cell(serial)="data">{{ data.index + 1 }}</template>
      <template #cell(name)="data">{{ data.item.user.name }}</template>
      <template #cell(code)="data">{{ data.item.user.code }}</template>
      <template #cell(actions)="data">
        <BButton variant="danger" size="sm" @click="router.delete(route('team.member.destroy', [teamId, data.item.id]))">
          Delete
        </BButton>
      </template>
    </BTable>
  </div>
</template>
