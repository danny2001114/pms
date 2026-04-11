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

// ==== import ==== //
defineProps({
  form: {
    type: Object,
    required: true,
  },
  fields: {
    type: Object,
    required: true,
  },
  action: {
    type: String,
    required: true,
  }
});

// ==== emiters ==== //
const emit = defineEmits([
  'onSubmit',
  'onBack'
]);
</script>
<template>
  <BForm @submit.prevent="emit('onSubmit')">
    <BCard>
      <template #header>
        <FormControl 
          v-model="form.description" 
          :group="false" 
          type="textarea" 
          field="description" 
          :error="form.errors.description"
          placeholder="Describe about the project info..." />
      </template>
      <BRow 
        v-for="([field, attr]) in Object.entries(fields)" 
        :key="field" 
        class="my-2">
        <BCol cols="2">{{ attr.label ?? useHumanizeStr(field, 'id') }}</BCol>
        <BCol cols="8">
          <FormControl 
            v-model="form[field]" 
            :label="attr.label" :type="attr.type" 
            :field="field" 
            :group="false"
            :error="form.errors[field]" 
            :options="attr.options" />
        </BCol>
      </BRow>
    </BCard>
    <div class="mt-3">
      <BButton 
        variant="outline-secondary" 
        @click="emit('onBack')" 
        class="me-2">
        Back
      </BButton>
      <BButton 
        variant="primary" 
        type="submit">
        {{ action }}
      </BButton>
    </div>
  </BForm>
</template>
