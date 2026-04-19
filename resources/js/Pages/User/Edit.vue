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
import InfoAlert from '@/Components/InfoAlert.vue';

const props = defineProps({
  user: Object,
  roles: Array,
  genders: Array
});

const form = useForm({
  name: props.user.name,
  role: props.user.role,
  gender: props.user.gender,
  email: props.user.email,
  phone: props.user.phone
});
</script>
<template>
  <InfoAlert />
  <BForm @submit.prevent="form.put(route('user.update', user.id))">
    <BCard>
      <template #header>
        <h3>Edit User</h3>
      </template>

      <div class="d-flex flex-column gap-3">
        <BFormGroup label-for="name" label="Name" :state="!form.errors.name">
          <BFormInput type="text" id="name" name="name" v-model="form.name" />
          <BFormInvalidFeedback>{{ form.errors.name }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label="Role">
          <BFormRadioGroup :options="roles" id="role" name="role" v-model="form.role" :state="!form.errors.role" />
          <BFormInvalidFeedback :state="!form.errors.role">{{ form.errors.role }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label="Gender">
          <BFormRadioGroup :options="genders" id="gender" name="gender" v-model="form.gender" :state="!form.errors.gender" />
          <BFormInvalidFeedback :state="!form.errors.genders">{{ form.errors.gender }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label-for="email" label="Email" :state="!form.errors.email">
          <BFormInput type="email" id="email" name="email" v-model="form.email" />
          <BFormInvalidFeedback>{{ form.errors.email }}</BFormInvalidFeedback>
        </BFormGroup>

        <BFormGroup label-for="phone" label="Phone" :state="!form.errors.phone">
          <BFormInput type="tel" id="phone" name="phone" v-model="form.phone" />
          <BFormInvalidFeedback>{{ form.errors.phone }}</BFormInvalidFeedback>
        </BFormGroup>
      </div>
    </BCard>

    <div class="d-flex gap-2 justify-content-start my-3">
      <BButton variant="outline-secondary" type="button" @click="router.visit(route('user.index'))">Back</BButton>
      <BButton variant="primary" type="submit">Update</BButton>
    </div>
  </BForm>
</template>
