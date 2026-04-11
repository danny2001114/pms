<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Aside from '@/Layouts/Aside.vue';
import PageLoading from '@/Layouts/PageLoading.vue';

const isLoading = ref(false);

function goRoute(url) {
  router.visit(route(url), {
    onStart: () => isLoading.value = true,
    onFinish: () => isLoading.value = false,
  });
}
</script>
<style>
  main {
    width: 100%;
    height: max-content;
    min-height: 100vh;
  }
</style>
<template>
  <PageLoading :show="isLoading">
    <div class="d-flex">
      <Aside @onLink="goRoute" />
        <main>
          <slot />
        </main>
    </div>
  </PageLoading>
</template>
