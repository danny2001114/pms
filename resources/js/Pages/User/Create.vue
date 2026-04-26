<script setup>
import {
  BForm,
  BFormGroup,
  BFormInput,
  BFormInvalidFeedback,
  BFormRadioGroup,
  BCard,
  BButton
} from 'bootstrap-vue-next';
import { useForm, router } from '@inertiajs/vue3';

defineProps({
  roles: Array,
  genders: Array
});

const form = useForm({
  name: '',
  password: '',
  role: 1,
  gender: '',
  email: '',
  phone: '',
});
</script>
<template>
  <h3 class="m-0">Create User</h3>
  <hr>

  <BForm @submit.prevent="form.post(route('user.store'))">
    <BCard>
      <template #header>
        <BFormInput type="text" id="name" placeholder="Enter User Name ..." v-model="form.name" />
        <div class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</div>
      </template>

      <div class="d-flex flex-column gap-3">
        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="password" label="Password">
          <BFormInput type="password" id="password" v-model="form.password" />
          <div class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="" label="Role">
          <BFormRadioGroup :options="roles" id="role" v-model="form.role" />
          <div class="text-danger" v-if="form.errors.role">{{ form.errors.role }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="" label="Gender">
          <BFormRadioGroup :options="genders" id="gender" v-model="form.gender" />
          <div class="text-danger" v-if="form.errors.gender">{{ form.errors.gender }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="email" label="Email">
          <BFormInput type="email" id="email" v-model="form.email" />
          <div class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</div>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="phone" label="Phone">
          <BFormInput type="tel" id="phone" v-model="form.phone" />
          <div class="text-danger" v-if="form.errors.phone">{{ form.errors.phone }}</div>
        </BFormGroup>
      </div>
    </BCard>

    <div class="d-flex gap-2 justify-content-start my-3">
      <BButton variant="outline-secondary" type="button" @click="router.visit(route('user.index'))">Back</BButton>
      <BButton variant="primary" type="submit">Create</BButton>
    </div>
  </BForm>
</template>
