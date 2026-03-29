<template>
  <div class="container mt-5">
    <h1 class="mb-4">Edit Post</h1>
    <BForm @submit.prevent="submit">
      <BFormGroup label="Title" label-for="title">
        <BFormInput
          id="title"
          v-model="form.title"
          :state="form.errors.title ? false : null"
          placeholder="Enter title"
        />
        <BFormInvalidFeedback>{{ form.errors.title }}</BFormInvalidFeedback>
      </BFormGroup>
      <BFormGroup label="Content" label-for="content">
        <BFormTextarea
          id="content"
          v-model="form.content"
          :state="form.errors.content ? false : null"
          placeholder="Enter content"
          rows="5"
        />
        <BFormInvalidFeedback>{{ form.errors.content }}</BFormInvalidFeedback>
      </BFormGroup>
      <BButton type="submit" variant="primary" :disabled="form.processing">
        Update Post
      </BButton>
      <BButton variant="secondary" :href="route('posts.index')" class="ms-2">
        Cancel
      </BButton>
    </BForm>
  </div>
</template>

<script setup>
import { BForm, BFormGroup, BFormInput, BFormTextarea, BButton, BFormInvalidFeedback } from 'bootstrap-vue-next';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  post: Object
});

const form = useForm({
  title: props.post.title,
  content: props.post.content,
});

const submit = () => {
  form.put(route('posts.update', props.post.id));
};
</script>