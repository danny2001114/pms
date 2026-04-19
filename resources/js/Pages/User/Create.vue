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
  <BForm @submit.prevent="form.post(route('user.store'))">
    <BCard>
      <template #header>
        <h3>Create User</h3>
      </template>

      <div class="d-flex flex-column gap-3">
        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="name" label="Name" :state="!form.errors.name">
          <BFormInput type="text" id="name" name="name" v-model="form.name" />
          <BFormInvalidFeedback>{{ form.errors.name }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="password" label="Password" :state="!form.errors.password">
          <BFormInput type="password" id="password" name="password" v-model="form.password" />
          <BFormInvalidFeedback>{{ form.errors.password }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="" label="Role">
          <BFormRadioGroup :options="roles" id="role" name="role" v-model="form.role" :state="!form.errors.role"/>
          <BFormInvalidFeedback :state="!form.errors.role">{{ form.errors.role }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="" label="Gender">
          <BFormRadioGroup :options="genders" id="gender" name="gender" v-model="form.gender" :state="!form.errors.gender"/>
          <BFormInvalidFeedback :state="!form.errors.gender">{{ form.errors.gender }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="email" label="Email" :state="!form.errors.email">
          <BFormInput type="email" id="email" name="email" v-model="form.email" />
          <BFormInvalidFeedback>{{ form.errors.email }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label-cols="12" label-cols-md="4" label-cols-lg="2" label-for="phone" label="Phone" :state="!form.errors.phone">
          <BFormInput type="tel" id="phone" name="phone" v-model="form.phone" />
          <BFormInvalidFeedback>{{ form.errors.phone }}</BFormInvalidFeedback>
        </BFormGroup>
      </div>
    </BCard>

    <div class="d-flex gap-2 justify-content-start my-3">
      <BButton variant="outline-secondary" type="button" @click="router.visit(route('user.index'))">Back</BButton>
      <BButton variant="primary" type="submit">Create</BButton>
    </div>
  </BForm>
</template>
