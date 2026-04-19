<script setup>
import BaseForm from '@/Pages/Team/BaseForm.vue';
import { router, useForm } from '@inertiajs/vue3';

// ==== props ==== //
const props = defineProps({
  team: Object
});

// ==== forms ==== //
const form = useForm({
  name: props.team.name,
  leader_code: props.team.leader.code,
  description: props.team.description
});

// ==== vars ==== //
const fields = {
  name: {
    type: 'text'
  },
  leader_code: {
    type: 'text',
    label: 'Leader'
  }
};
</script>
<template>
  <BaseForm :form="form" :fields="fields" action="Update" @onSubmit="form.put(route('team.update', team.id))"
    @onBack="router.visit(route('team.show', team.id))" />
</template>
