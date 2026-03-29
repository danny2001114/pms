<template>
  <div class="container mt-5">
    <h1 class="mb-4">Create Post</h1>
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
        Create Post
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

const form = useForm({
  title: '',
  content: '',
});

const submit = () => {
  form.post(route('posts.store'));
};
</script>
