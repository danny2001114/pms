<script setup>
import {
  BButton,
  BCard,
  BRow,
  BCol,
  BForm
} from 'bootstrap-vue-next';
import { useHumanizeStr } from '@/Utilities/helpers';
import FormControl from '@/Components/FormControl.vue';

// === props ==== //
defineProps({
  form: {
    type: Object,
    required: true
  },
  fields: {
    type: Object,
    required: true
  },
  action: {
    type: String,
    required: true
  }
});

// === emiters ==== //
const emit = defineEmits([
  'onSubmit',
  'onBack'
]);
</script>
<template>
  <BForm @submit.prevent="emit('onSubmit')">
    <BCard>
      <template #header>
        <h3>
          <FormControl v-model="form.title" type="text" field="title" :group="false" :error="form.errors.title"
            :feedback="false" placeholder="Enter project title" />
        </h3>
      </template>
      <BRow v-for="([field, attr]) in Object.entries(fields)" :key="field" class="my-2">
        <BCol cols="2">
          {{ attr.label ?? useHumanizeStr(field, 'id') }}
        </BCol>
        <BCol cols="8">
          <FormControl v-model="form[field]" :label="attr.label" :type="attr.type" :field="field" :group="false"
            :error="form.errors[field]" :options="attr.options" />
        </BCol>
      </BRow>
      <hr>
      <FormControl v-model="form.description" type="textarea" field="description" :error="form.errors.description"
        placeholder="Describe about the project info..." />
    </BCard>
    <div class="mt-3">
      <BButton variant="outline-secondary" @click="emit('onBack')" class="me-2">
        Back
      </BButton>
      <BButton variant="primary" type="submit">
        {{ action }}
      </BButton>
    </div>
  </BForm>
</template>
