<script setup>
import { BButton } from 'bootstrap-vue-next';
import ScrollableTable from '@/Components/ScrollableTable.vue';

// ==== props ==== //
const props = defineProps({
  teamId: {
    type: Number,
    required: true
  },
  leaderId: {
    type: Number,
    required: true
  },
  members: {
    type: Object,
    required: true
  }
});


// ==== vars ==== //
const fields = [
  { key: 'serial', label: '.No' },
  { key: 'name', label: 'Name' },
  { key: 'code', label: 'Code' },
  { key: 'actions', label: 'Actions' }
];

// ==== actions ==== //
function destroy(id) {
  if (confirm('Are you sure you want to delete this member?')) {
    router.delete(route('team.member.destroy', id));
  }
}
</script>
<template>
  <ScrollableTable :list="members" :show-total="false" :fields="fields" @onDestroy="destroy">
    <template #cell(actions)="data">
      <BButton variant="danger" size="sm" @click="emit('onDestroy', data.item.id)"
        v-if="data.item.user_id !== leaderId">
        Delete
      </BButton>
    </template>
  </ScrollableTable>
</template>
