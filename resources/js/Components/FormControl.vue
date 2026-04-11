<script setup>
import {
  BFormInput,
  BFormInvalidFeedback,
  BFormTextarea,
  BFormSelect,
  BFormCheckbox,
  BFormGroup
} from 'bootstrap-vue-next';
import { useHumanizeStr } from '../Utilities/helpers';
import { computed } from 'vue';

// ==== porps ==== //
const props = defineProps({
  modelValue: [String, Number, Boolean],
  type: {
    type: String,
    required: true,
  },
  field: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    default: ''
  },
  group: {
    type: Boolean,
    default: true
  },
  error: {
    type: String,
    default: ''
  },
  feedback: {
    type: Boolean,
    default: true
  },
  placeholder: {
    type: String,
    default: ''
  },
  options: {
    type: Array,
    default: []
  },
  rows: {
    type: Number,
    default: 5
  }
});

// ==== emiters ==== //
const emit = defineEmits(['update:modelValue']);

// ==== computors ==== //
const errorMessage = computed(() => {
  if (props.type == 'select' && !props.options.length) return "There is no options for " + props.label ?? useHumanizeStr(props.field);
  else return props.error;
});
</script>
<template>
  <BFormGroup
    v-if="group"
    :label="useHumanizeStr(field)"
    :label-for="field">
    <component
      :is="type === 'select' ? BFormSelect
          : type === 'switch' ? BFormCheckbox
          : type === 'textarea' ? BFormTextarea
          : BFormInput"
      :id="field"
      :model-value="modelValue"
      :options="type === 'select' ? options : undefined"
      :rows="type === 'textarea' ? rows : undefined"
      :type="type !== 'select' && type !== 'textarea' ? type === 'switch' ? 'checkbox' : type : undefined"
      :placeholder="placeholder"
      :state="errorMessage ? false : null"
      :disabled="(type == 'select' && !props.options.length)"
      @update:model-value="val => emit('update:modelValue', val)"
      switch/>
    <BFormInvalidFeedback v-if="feedback">{{ errorMessage }}</BFormInvalidFeedback>
  </BFormGroup>
  <template v-else>
    <component
      :is="type === 'select' ? BFormSelect
          : type === 'switch' ? BFormCheckbox
          : type === 'textarea' ? BFormTextarea
          : BFormInput"
      :id="field"
      :model-value="modelValue"
      :options="type === 'select' ? options : undefined"
      :rows="type === 'textarea' ? rows : undefined"
      :type="type !== 'select' && type !== 'textarea' ? type === 'switch' ? 'checkbox' : type : undefined"
      :placeholder="placeholder"
      :state="errorMessage ? false : null"
      :disabled="(type == 'select' && !props.options.length)"
      @update:model-value="val => emit('update:modelValue', val)"
      switch/>
    <BFormInvalidFeedback v-if="feedback">{{ errorMessage }}</BFormInvalidFeedback>
  </template>
</template>
