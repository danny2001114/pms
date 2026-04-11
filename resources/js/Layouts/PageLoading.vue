<script setup>
import { 
  BOverlay 
} from 'bootstrap-vue-next';
import { computed } from 'vue';

defineProps({
  show: {
    type: Boolean,
    required: true
  }
});
</script>
<template>
      <BOverlay
        id="overlay-background"
        :show="show"
        variant="light"
        opacity="0.85"
        blur="2px"
        rounded="sm"
      >
        <slot />
      </BOverlay>
</template>
