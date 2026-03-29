<template>
  <div class="container mt-5">
    <h1 class="mb-4">{{ post.title }}</h1>
    <p>{{ post.content }}</p>
    <p><small class="text-muted">Created at: {{ post.created_at }}</small></p>
    <BButton variant="primary" :href="route('posts.index')" class="me-2">
      Back to Posts
    </BButton>
    <BButton variant="warning" :href="route('posts.edit', post.id)">
      Edit
    </BButton>
  </div>
</template>

<script setup>
import { BButton } from 'bootstrap-vue-next';

defineProps({
  post: Object
});
</script>