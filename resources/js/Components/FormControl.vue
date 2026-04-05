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

const props = defineProps({
  modelValue: [String, Number, Boolean],
  type: String,
  field: String,
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
    default: () => []
  },
  rows: {
    type: Number,
    default: 5
  }
});

const errorMessage = computed(() => {
  let message = props.error;

  if (props.type == 'select' && !props.options.length) {
    message = "There is no options for " + props.label ?? useHumanizeStr(props.field);
  }
  
  return message;
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
  <BFormGroup
    v-if="group"
    :label="useHumanizeStr(field)"
    :label-for="field"
  >
    <component
      :is="type === 'select' ? BFormSelect
          : type === 'switch' ? BFormCheckbox
          : type === 'textarea' ? BFormTextarea
          : BFormInput"
      :id="field"
      :model-value="modelValue"
      :options="type === 'select' ? options : undefined"
      :rows="type === 'textarea' ? rows : undefined"
      :type="type !== 'select' && type !== 'switch' && type !== 'textarea' ? type : undefined"
      :placeholder="placeholder"
      :state="errorMessage ? false : null"
      :disabled="(type == 'select' && !props.options.length)"
      @update:model-value="val => emit('update:modelValue', val)"
      switch
    />

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
      :type="type !== 'select' && type !== 'switch' && type !== 'textarea' ? type : undefined"
      :placeholder="placeholder"
      :state="errorMessage ? false : null"
      :disabled="(type == 'select' && !props.options.length)"
      @update:model-value="val => emit('update:modelValue', val)"
      switch
    />

    <BFormInvalidFeedback v-if="feedback">{{ errorMessage }}</BFormInvalidFeedback>
  </template>
</template>
