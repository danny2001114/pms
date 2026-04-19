<script setup>
import BaseForm from '@/Pages/Team/BaseForm.vue';
import { useForm, router } from '@inertiajs/vue3';

// ==== forms ==== //
const form = useForm({
  name: '',
  leader_code: '',
  image: '',
  description: '',
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
  <BaseForm :form="form" :fields="fields" action="Create" @onSubmit="form.post(route('team.store'))"
    @onBack="router.visit(route('team.index'))" />
</template>
