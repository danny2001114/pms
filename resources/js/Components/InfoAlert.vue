<script setup>
import { ref, watch, onUnmounted } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { BAlert } from 'bootstrap-vue-next'

const page = usePage()
const show = ref(false)
const message = ref('')
const variant = ref('success')
const countDown = ref(0)
let timer = null

watch(
  () => [
    page.props.flash?.success,
    page.props.flash?.warning,
    page.props.errors?.failed
  ],
  ([success, warning, failed]) => {
    if (success || warning || failed) {
      message.value = success || warning || failed
      variant.value = success
        ? 'success'
        : warning
        ? 'warning'
        : 'danger'

      start(5)
    }
  },
  { immediate: true }
)

function start(seconds) {
  clearInterval(timer)

  show.value = true
  countDown.value = seconds

  timer = setInterval(() => {
    if (countDown.value > 0) {
      countDown.value--
    } else {
      stop()
    }
  }, 1000)
}

function stop() {
  clearInterval(timer)
  show.value = false
  message.value = ''
}

onUnmounted(() => clearInterval(timer))
</script>

<template>
  <BAlert
    v-show="show"
    :variant="variant"
    dismissible
    @dismissed="stop"
  >
    {{ message }}
  </BAlert>
</template>
